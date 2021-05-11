<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use View;
use Mail;
use App\User;
use App\Customer;
use App\Designer;
use App\Helpers\Helper;
use App\Collection;
use App\CollectionImages;
use App\CollectionBluePrints;
use App\CollectionRule;
use App\ProductTag;
use App\ProductImages;
use App\ProductVariant;
use App\Product;
use App\Vendor;
use App\CollectionColorPallettes;
use App\DigitalProduct;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Osiset\BasicShopifyAPI\Options;
use Osiset\BasicShopifyAPI\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Spatie\Activitylog\Models\Activity;
use Osiset\BasicShopifyAPI\BasicShopifyAPI;
use App\Http\Requests\CollectionStoreRequest;
use App\Http\Requests\DesignerStoreRequest;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\UpdateCollectionRequest;
use Carbon\Carbon;
use App\Order;
use Illuminate\Support\Facades\Storage;

class DesignerController extends Controller
{

    public function dashboard($id)
    {

        $inprogressDesigns = Collection::where('designer_id', $id)->where('status', 'disabled')->count();

        //return $inprogressDesigns;
        $draftDesigns = Collection::where('designer_id', $id)->where('status', 'draft')->count();
        $publishedDesigns = Collection::where('designer_id', $id)->where('published', false)->where('status', 'approved')->count();
        $underReviewDesigns = Collection::where('designer_id', $id)->where('published', false)->where('status', 'submitted')->count();
        $reassignedDesigns = Collection::where('designer_id', $id)->where('status', 'reassign')->count();
        $designs = Collection::where('designer_id', $id)->with('designer')->with('collectionImages')->where('status', 'approved')->get();

        $designer = Designer::find($id);

        $dataCards = view('designer.dashboardStatistics')->with('inprogressDesigns', $inprogressDesigns)->with("draftDesigns", $draftDesigns)->with("publishedDesigns", $publishedDesigns)->with("underReviewDesigns", $underReviewDesigns)->with('reassignedDesigns',$reassignedDesigns)->render();

        $designCards = view('designer.mydesigns')->with('designs', $designs)->render();

        return response()->json(['status'=>201, 'success' => true, 'data'=>["dataCards"=>$dataCards, "designCards"=>$designCards, "designer"=>$designer], 'message'=>'Designer Dashboard loaded successfully'])->setStatusCode(200);
    }

    /**
     * This method is used to upload the designer file resume / portfolio.
     */
    public function uploadFile(Request $request) {
        $allData = $request->all();
        Log::info("upload file method :: ".print_r($allData, true));

        $file = $request->file($request->type);
        Log::info("upload file :: ".print_r($file, true));

        if(isset($request->type) && $request->type != '') {
            if($request->type == config('constants.DESIGNER_RESUME')) {
                $inputs['folder']       = config('constants.DESIGNER_RESUME_UPLOAD_S3_OBJECT');
                $inputs['filePrefix']   = "resume_";
            } else if($request->type == config('constants.DESIGNER_PORTFOLIO')) {
                $inputs['folder']       = config('constants.DESIGNER_PORTFOLIO_UPLOAD_S3_OBJECT');
                $inputs['filePrefix']   = "portfolio_";
            } else {
                $inputs['folder']       = "";
                $inputs['filePrefix']   = "";
            }
            $inputs['file'] = $file;

            Log::info("upload file :: before send to s3 :: inputs :: ".print_r($inputs, true));
            $url = app('App\Http\Controllers\FileController')->store($inputs);
            Log::info("upload file :: after sent to s3 :: url :: ".print_r($url, true));

            if($url) {
                return response()->json(['status'=> 1, 'success' => true, 'data' => [ "url" => $url], 'message' => 'file uploaded successfully.'])->setStatusCode(200);
            } else {
                return response()->json(['status'=> 0, 'success' => false, 'data' => [], 'message' => 'file upload failed.'])->setStatusCode(200);
            }
        } else {
            return response()->json(['status'=> 0, 'success' => false, 'data' => [], 'message' => 'file upload failed.'])->setStatusCode(200);
        }
    }

    public function store(DesignerStoreRequest $request)
    {
        Log::info("in store method :: ".print_r($request->all(), true));

        $shop = User::where('name', $request->shop)->first();
        $options = new Options();
        $options->setVersion('2021-01');
        $api = new BasicShopifyAPI($options);
        $api->setSession(new Session($shop->name, $shop->password));

        try {
            $communication_channel = [];
            $displayPictureFileName = "";
            $resumeFileName = "";
            $portfolioFileName = "";
            $password = "";
            $display_picture = $request->file('display_picture');
            $resume = $request->file('resume');
            $portfolio = $request->file('portfolio');
            $status = 'pending';
            $success_message = "Designer Account Created successfully and activation email sent to email box";
            $emailTemplate = "emails.designerAccount";
            $emailSubject = "Designer Account Created successfully!";
            $role = "designer";
            //$success_message = 'New account has been created successfully to shopify, Account activation link has been sent to your email account!';

            if (!empty($display_picture)) {
                //Display File Name
                $displayPictureFileName = $display_picture->getClientOriginalName();

                //Move Uploaded File
                $destinationPath = public_path() . '/uploads/designer/display_picture/';
                $display_picture->move($destinationPath, $display_picture->getClientOriginalName());
            }


            // if (!empty($resume)) {
            //     //Display File Name
            //     $resumeFileName = $resume->getClientOriginalName();

            //     //Move Uploaded File
            //     $destinationPath = public_path() . '/uploads/designer/resume/';
            //     $resume->move($destinationPath, $resume->getClientOriginalName());
            // }

            // if (!empty($portfolio)) {
            //     //Display File Name
            //     $portfolioFileName = $portfolio->getClientOriginalName();

            //     //Move Uploaded File
            //     $destinationPath = public_path() . '/uploads/designer/portfolio/';
            //     $portfolio->move($destinationPath, $portfolio->getClientOriginalName());
            // }

            $data = [
                'customer' => [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'verified_email' => true,
                    'password' => $password,
                    'password_confirmation' => $password,
                    'send_email_invite' => true,
                    'metafields' => [
                        [
                            "key" => "display_picture",
                            "value" => "uploads/user/display_picture/" . $displayPictureFileName,
                            "value_type" => "string",
                            "namespace" => "global"

                        ],
                        [
                            "key" => "resume",
                            "value" => $request->resumeUrl,
                            "value_type" => "string",
                            "namespace" => "global"

                        ], [
                            "key" => "portfolio",
                            "value" => $request->portfolioUrl,
                            "value_type" => "string",
                            "namespace" => "global"

                        ], [
                            "key" => "status",
                            "value" => $status,
                            "value_type" => "string",
                            "namespace" => "global"

                        ],
                        [
                            "key" => "tag",
                            "value" => $request->tag,
                            "value_type" => "string",
                            "namespace" => "global"

                        ]
                    ]
                ]
            ];


            try {
                $result = $api->rest('POST', '/admin/customers.json', $data)['body'];
            } catch (\Exception $e) {
                Log::info($e->getMessage());
                return response()->json(['status' => 422, "errors" => $e->getMessage()])->setStatusCode(422);
            }

            Log::info("result " . json_encode($result));

            if (isset($result['customer'])) {
                $designer = Designer::create([
                    'id' => $result['customer']['id'],
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'phone' => $request->phone,
                    'status' => $status,
                    'display_picture' => $displayPictureFileName,
                    'resume' => $request->resumeUrl,
                    'portfolio' => $request->portfolioUrl,
                    'tag' => $request->tag,
                    'bio' => $request->bio,
                    'quote' => $request->quote,
                    'business_name' => $request->business_name,
                    'business_address' => $request->business_address,
                    'website_url' => $request->website_url
                ]);

                $temp = $designer;
                $data = $temp->toArray();
                $template = $emailTemplate;
                $subject = $emailSubject;
                $fromEmail = "panacchebeta@gmail.com";
                $fromName = "Panacche Team";
                $toEmail = $request->email;
                $emailTitle = "Account Creation";

                if (!empty($designer->id)) {
                    // Model has been successfully inserted
                    $myEmail = Helper::sendmail($data, $template, $subject, $fromEmail, $fromName, $toEmail, $emailTitle);
                    if (empty($myEmail)) {
                        Log::info("mail has been sent because empty no error " . $myEmail);

                        $log_message = "Account creation email has been sent to " . $role;

                        Helper::log_activity($designer, $designer, $designer, $log_message);
                    } else {
                        $log_message = "Due to some error account creation email has not sent to " . $role;
                        Helper::log_activity($designer, $designer, $designer, $log_message);
                    }

                    Helper::log_activity($designer, $designer, $designer, $success_message);

                    return response()->json(['status' => 201, 'data' => $request->all(), 'message' => $success_message])->setStatusCode(201);
                } else {
                    $data = $request->all();
                    $template = "emails.accountNotCreated";
                    $subject = "Record is created in shopify but not is App due to some error";
                    $toEmail = "admin@admin.com"; // or admin@panacche.com
                    $emailTitle = "Record is not created in app";
                    $myEmail = Helper::sendmail($data, $template, $subject, $fromEmail, $fromName, $toEmail, $emailTitle);
                    $log_message = "Record is created in shopify but not is App due to some error";
                    $newCustomer = new Customer();
                    Helper::log_activity($newCustomer, $designer, $data, $log_message);
                }
            } else {
                return response()->json(['status' => 422, 'errors' => $result])->setStatusCode(422);
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return response()->json(['status' => 422, "errors" => $e->getMessage()])->setStatusCode(422);
        }
    }

    public function inProgress($id){
        $designs  = Collection::with(['designer','collectionImages'])->where('designer_id', $id)->where('status', 'disabled')->with('collectionImages')->get();
        $designCards = view('designer.inprogress')->with('designs', $designs)->render();

        return response()->json(['status'=>201, 'success' => true, 'data'=>["designCards"=>$designCards], 'message'=>'Inprogress designs loaded successfully'])->setStatusCode(200);
    }

    public function draft($id){
        $designs  = Collection::with(['designer','collectionImages'])->with('designer')->where('designer_id', $id)->where('status', 'draft')->get();
        $designCards = view('designer.draft')->with('designs', $designs)->render();

        return response()->json(['status'=>201, 'success' => true, 'data'=>["designCards"=>$designCards], 'message'=>'Draft designs loaded successfully'])->setStatusCode(200);
    }

    public function reassign($id){
        $designs  = Collection::with(['designer','collectionImages'])->where('designer_id', $id)->where('status', 'reassign')->get();
        $designCards = view('designer.reassign')->with('designs', $designs)->render();

        return response()->json(['status'=>201, 'success' => true, 'data'=>["designCards"=>$designCards], 'message'=>'Reassign designs loaded successfully'])->setStatusCode(200);
    }



    public function published($id){
        $designs  = Collection::with(['designer','collectionImages'])->where('designer_id', $id)->where('status', 'approved')->get();
        $designCards = view('designer.published')->with('designs', $designs)->render();

        return response()->json(['status'=>201, 'success' => true, 'data'=>["designCards"=>$designCards], 'message'=>'published designs loaded successfully'])->setStatusCode(200);
    }

    public function under_review($id){
        $designs  = Collection::with(['designer','collectionImages'])->where('designer_id', $id)->where('status', 'submitted')->get();
        $designCards = view('designer.under_review')->with('designs', $designs)->render();

        return response()->json(['status'=>201, 'success' => true, 'data'=>["designCards"=>$designCards], 'message'=>'Designs under review loaded successfully'])->setStatusCode(200);
    }

    public function allDesigns($id){
        $designs  = Collection::with(['designer','collectionImages'])->where('designer_id', $id)->get();
        $designCards = view('designer.allDesigns')->with('designs', $designs)->render();

        return response()->json(['status'=>201, 'success' => true, 'data'=>["designCards"=>$designCards], 'message'=>'All designs loaded successfully'])->setStatusCode(200);
    }

    public function viewAllOrders($id){
        $orders = Order::with('collection','collection.designer', 'customer')->
        where('designer_id', $id)->get();
        $orders = view('designer.designer-view-all-orders')->with('orders', $orders)->render();

        return response()->json(['status'=>201, 'success' => true, 'data'=>["orders"=>$orders], 'message'=>'All orders loaded successfully'])->setStatusCode(200);

    }

    public function viewAllDesigns($id)
    {
        $designs = Collection::with(['designer','collectionImages'])->with('designer','orders')->where('designer_id', $id)->get();
        $designs = view('designer.designer-view-all-designs')->with('designs', $designs)->render();
        return response()->json(['status'=>200, 'success' => true, 'data'=>['designs' => $designs ]])->setStatusCode(200);
    }

    public function createDesign($id){
        $design = Collection::with(['designer', 'collectionImages','bluePrintImages','colorPallettes','products', 'products.productImages', 'products.vendor'])->find($id);
        $vendors = Vendor::all();

        $design = view('designer.createDesign')->with('design', $design)->with('vendors', $vendors)->render();


        return response()->json(['status'=>201, 'success' => true, 'data'=>["design"=>$design], 'message'=>'Design loaded successfully'])->setStatusCode(200);

    }


    public function updateProduct(ProductStoreRequest $request)
    {


        $productImages = $request->file('product_images');

        try {
            $customer = Designer::find($request->customer_id);
            if (!($customer->status)) {
                return response()->json(['status' => 500, 'errors' => ["designer" => "Account not found"]])->setStatusCode(422);
            }

            if ($customer->status == 'pending' || $customer->status == 'disabled') {
                return response()->json(['status' => 500, 'errors' => ["designer" => "AYour account is not approved yet to create design, contact Admin!"]])->setStatusCode(422);
            }

            $collection = Collection::find($request->collection_id);
            if (!($collection)) {
                return response()->json(['status' => 500, 'errors' => ["design" => "Design or Room not found"]])->setStatusCode(422);
            }


            $shop = User::where('name', $request->shop)->first();
            $options = new Options();
            $options->setVersion('2021-01');
            $api = new BasicShopifyAPI($options);
            $api->setSession(new Session($shop->name, $shop->password));

            //$productImagesArr = [];

            $images = [];
            $current_time = Carbon::now()->timestamp;
            $productImageFileName = "";

            if ($request->hasfile('product_images')) {
                Log::info("has file product_images");
                foreach ($productImages as $productImage) {
                    Log::info("single product img");
                    $productImageFileName = $current_time . '_' . $productImage->getClientOriginalName();
                    //Move Uploaded File
                    $destinationPath = public_path() . 'uploads/collection/' . $collection->id . '/';
                    $productImage->move($destinationPath, $productImageFileName);
                    $url = env('APP_URL') .'/uploads/collection/' . $collection->id . '/' . $productImageFileName;
                    $image = [
                        "src" => $url
                    ];
                   array_push($images, $image);
                }
            }

            Log::info("images : " . json_encode($images));



            $data = [
                "product" => [
                    "id" => $request->product_id,
                    "title" => $request->merchandise,
                    "product_type" => '',
                    "description" => $request->product_description,
                    "published" => false,
                    "inventory_quantity"=> $request->quantity,
                    "tags" => [
                        $collection->design_name,
                    ],
                    "variants"=> [
                        [
                          "option1"=> "Default Title",
                          "price"=> $request->product_price,
                          "inventory_quantity" => $request->quantity,
                          //"sku": "123"
                        ],
                    ],
                    "images" => $images,
                ]
            ];

            $result = $api->rest('PUT', '/admin/products/'.$request->product_id.'.json', $data)['body'];
            Log::info('result' . json_encode($result));
            if (isset($result['product'])) {

                $product = Product::where('id', $request->product_id)->update([
                    'vendor_id' => $request->vendor_id,
                    'collection_id' => $collection->id,
                    'title' => $request->merchandise,
                    'description' => $request->product_description,
                    'size_specification' => $request->size_specification,
                    'product_url' => $request->product_url,
                    'product_price' => $request->product_price,
                    'product_compare_at_price' => $request->compare_at_price,
                    'product_quantity' => $request->quantity,
                ]);

                ProductImages::where('product_id', $request->product_id)->delete();
                $current_time = Carbon::now()->timestamp;

                Log::info("current_time" . json_encode($current_time));

                if ($request->hasfile('product_images')) {
                    Log::info("has file product_images");
                    foreach ($productImages as $productImage) {

                        ProductImages::create([
                            'product_id' => $product->id,
                            'img_src' => $productImageFileName,
                            'img_alt' => $productImageFileName,
                        ]);
                    }
                }



                $products = Product::with('vendor,productImages')->where('collection_id', $collection->id)->get();

                Log::info('final product' . json_encode($product));
                $vendors = Vendor::all();
                $products = view('designer.newProduct')->with('products', $products)->with('customer', $customer)->with('collection', $collection)->with('vendors', $vendors)->render();
                return response()->json(['status'=>200, 'success' => true, 'data'=>["products"=>$products], 'message'=>'Your specifics have been altered successfully.'])->setStatusCode(200);

              } else {
                return response()->json(['status' => 500, 'errors' => $result]);
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return response()->json(['status' => 422, "errors" => $e->getMessage()])->setStatusCode(422);
        }
    }


    public function updateDesign(UpdateCollectionRequest $request)
    {

        try {

            $customer = Designer::find($request->customer_id);
            if (!($customer->status)) {
                return response()->json(['status' => 500, 'errors' => ["designer" => "Account not found"]])->setStatusCode(422);
            }

            if ($customer->status == 'pending' || $customer->status == 'disabled') {
                return response()->json(['status' => 500, 'errors' => ["designer" => "AYour account is not approved yet to create design, contact Admin!"]])->setStatusCode(422);
            }



            $shop = User::where('name', $request->shop)->first();
            $options = new Options();
            $options->setVersion('2021-01');
            $api = new BasicShopifyAPI($options);
            $api->setSession(new Session($shop->name, $shop->password));

            $collectionImages = $request->file('collection_images');

         //   Log::info('collection_images'. json_encode($collectionImages));


            $collectionBluePrints = $request->file('collection_blue_prints');
            $colorNames = $request->color_name;
            $colorBrand = $request->brand;
            $colorFinish = $request->finish;
            $colorApplication = $request->application;

            $room_width = $request->width_in_feet. "' ". $request->width_in_inches;
            $room_height = $request->height_in_feet. "' ". $request->height_in_inches;


            //Log::info("collectionImages count ---". json_encode($collectionImages));

            $collectionRule = [
                "column" => "tag",
                "relation" => "equals",
                "condition" => $request->design_name,
            ];


            $collectionMetafields = [
                [
                    "key" => "room_budget",
                    "value" => $request->room_budget,
                    "value_type" => "string",
                    "namespace" => "gloabal",
                ],
                [
                    "key" => "room_type",
                    "value" => $request->room_type,
                    "value_type" => "string",
                    "namespace" => "gloabal",
                ],
                [
                    "key" => "room_style",
                    "value" => $request->room_style,
                    "value_type" => "string",
                    "namespace" => "gloabal",
                ],
                [
                    "key" => "dig_description",
                    "value" => $request->implementation_guide_description,
                    "value_type" => "string",
                    "namespace" => "gloabal",
                ],

            ];


            //$collection_id = (int)$request->collection_id;

            //Log::info("collection_id ".$collection_id);
            $data = [
                "smart_collection" => [
                    "id" => $request->collection_id,
                    "title" => $request->design_name,
                    "published" => false,
                    //"metafields" => $collectionMetafields,
                    "rules" => [
                        $collectionRule
                    ],
                ]

            ];

            $result = $api->rest('PUT', '/admin/smart_collections/'.$request->collection_id.'.json', $data)['body'];


            $current_time = Carbon::now()->timestamp;

            Log::info("current_time" . json_encode($current_time));

            if (isset($result['smart_collection'])) {

                $designGuideFileName = "";

                $design_implementation_guide = $request->design_implementation_guide;
                if (!empty($design_implementation_guide)) {
                    //Display File Name

                    $designGuideFileName = $current_time . '_' . $design_implementation_guide->getClientOriginalName();

                    //Move Uploaded File
                    $destinationPath = public_path() . '/uploads/collection/' . $request->collection_id . '/';
                    $design_implementation_guide->move($destinationPath, $designGuideFileName);
                }
                Log::info("OK");

                $collection = Collection::where('id', $request->collection_id)->update([
                   // 'id' => $result['smart_collection']['id'],
                    'design_name' => $request->design_name,
                    'designer_id' => $request->customer_id,
                    'implementation_guide_description' =>$request->implementation_guide_description,
                    'published' => false,
                    'image_src' => $request->image_src,
                    'image_alt' => $request->image_alt,
                    'room_type' => $request->room_type,
                    'room_style' => $request->room_style,
                    'room_budget' => $request->room_budget,
                    'design_implementation_guide' => $designGuideFileName,
                    'room_width_in_feet' => $request->width_in_feet,
                    'room_width_in_inches' => $request->width_in_inches,
                    'room_height_in_feet' => $request->height_in_feet,
                    'room_height_in_inches' => $request->height_in_inches,
                    'pet_friendly_design' => $request->pet_friendly_design,
                    'design_price' => $request->design_price
                ]);
                Log::info("OK1");
                $digitalProduct = DigitalProduct::where('collection_id', $request->collection_id)->first();
                Log::info("Ok2");
                    if($digitalProduct){
                        $productData = [
                            "product" => [
                                "id" => $digitalProduct->id,
                                "title" => "Design Implementation Guide",
                                "product_type" => '',
                                "description" => $request->product_description,
                                "published" => false,
                                "product_type" => "design_implementation_guide",
                                "tags" => [
                                    $request->design_name,
                                    "design_implementation_guide"
                                ],
                                "variants"=> [
                                    [
                                      "option1"=> "Default Title",
                                      "price"=> $request->design_price,
                                      //"sku": "123"
                                    ],
                                ],
                            ]
                        ];
                        Log::info("OK3");

                        $productResult = $api->rest('POST', '/admin/products/'.$digitalProduct->id.'.json', $productData)['body'];
                        Log::info("OK4");
                        if($productResult){
                            DigitalProduct::where('collection_id', $request->collection_id)->update([
                                  //  'id' => $productResult['product']['id'],
                                    'collection_id' => $request->collection_id,
                                    'name' => 'Design Implementation Guide',
                                    'product_type' => 'design_implementation_guide',
                                    'product_price' => $request->design_price,
                                ]);
                        }


                        if($designGuideFileName){
                            DigitalProduct::where('collection_id', $request->collection_id)->update([
                                //  'id' => $productResult['product']['id'],
                                  'collection_id' => $request->collection_id,
                                  'name' => 'Design Implementation Guide',
                                  'product_type' => 'design_implementation_guide',
                                  'product_price' => $request->design_price,
                                  'file_path' => $designGuideFileName
                              ]);
                        }

                    }


                Log::info('collection ' . json_encode($collection));



                if ($request->hasfile('collection_images')) {
                    Log::info("has file collection images");
                    foreach ($collectionImages as $collectionImage) {
                        Log::info("single collection img");
                        $collectionImageFileName = $current_time . '_' . $collectionImage->getClientOriginalName();
                        //Move Uploaded File
                        $destinationPath = public_path() . '/uploads/collection/' . $request->collection_id.'/';
                        $collectionImage->move($destinationPath, $collectionImageFileName);

                        CollectionImages::create([
                            'collection_id' => $request->collection_id,
                            'img_src' => $collectionImageFileName,
                            'img_alt' => $collectionImageFileName,
                        ]);
                    }
                }

                if ($request->hasfile('collection_blue_prints')) {
                    Log::info("has file collection blue prints");
                    foreach ($collectionBluePrints as $collectionBluePrint) {
                        Log::info("single blue print img");
                        $collectionBluePrintFileName = $current_time . '_' . $collectionBluePrint->getClientOriginalName();
                        //Move Uploaded File
                        $destinationPath = public_path() . '/uploads/collection/' . $request->collection_id. '/';
                        $collectionBluePrint->move($destinationPath, $collectionBluePrintFileName);

                        CollectionBluePrints::create([
                            'collection_id' => $request->collection_id,
                            'img_src' => $collectionBluePrintFileName,
                            'img_alt' => $collectionBluePrintFileName,
                        ]);
                    }
                }


                if ($colorNames) {
                    $colorImgArr = [];
                    if ($request->hasfile('color_img')) {
                        foreach ($request->file('color_img') as $file) {
                            $name = $current_time . '_' . $file->getClientOriginalName();
                            $destinationPath = public_path() . '/uploads/collection/' . $request->collection_id.'/';
                            $file->move($destinationPath, $name);

                            $imgFileName = $name;
                            array_push($colorImgArr, $imgFileName);
                        }
                    }

                    for ($i = 0; $i < count($colorNames); $i++) {
                        $imgFileName = "";
                        $color_img_value = "";
                        if (isset($colorImgArr[$i])) {
                            $color_img_value = $colorImgArr[$i];
                        }
                        CollectionColorPallettes::create([
                            'collection_id' => $request->collection_id,
                            'color_img' => $color_img_value,
                            'color_name' => $colorNames[$i],
                            'brand' => $colorBrand[$i],
                            'finish' => $colorFinish[$i],
                            'application' => $colorApplication[$i]
                        ]);
                    }
                }

                return response()->json(['status' => 200, 'message' => "Your Particulars Have Been Modified Successfully.", "data" => $result])->setStatusCode(200);
            } else {
                return response()->json(['status' => 500, 'errors' => $result])->setStatusCode(422);
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return response()->json(['status' => 422, "message" => $e->getMessage()])->setStatusCode(422);
        }
    }

    public function viewDesignUnderReview($id){
        Log::info('collection id'. $id);
        $design = Collection::where('id', $id)->with('designer', 'collectionImages','bluePrintImages','colorPallettes','products', 'products.productImages', 'products.vendor')->get();

        Log::info('collection id'. json_encode($design));
        //return $design->products;
        $design = view('designer.viewDesign')->with('design', $design)->render();

        return response()->json(['status'=>200, 'success' => true, 'data'=>["design"=>$design], 'message'=>'Design loaded successfully'])->setStatusCode(200);

    }


}

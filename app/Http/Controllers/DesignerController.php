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
use App\CollectionColorPallettes;
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

class DesignerController extends Controller
{
    /*public function users($id)
    {
        // $customers = Customer::where('tag', 'role:designer')
        //     ->where('status', 'pending')
        //     ->get();

        // return View::make("admin.newDesigners")->with("customers", $customers);
    }*/

   /* public function designs($id)
    {
        $designs = Collection::where('customer_id', $id)->with('customer')->with('collectionImages')->get();
        //return $designs;
        $data = ['abc', "xyz", "lmn"];
        $template = "emails.mail";
        $subject = "just for testing";
        $fromEmail = "panacchebeta@gmail.com";
        $fromName = "Panacche Team";
        $toEmail = "nileshbari.8085@gmail.com";
        $emailTitle = "Account Creation";

        Helper::sendmail($data, $template, $subject, $fromEmail, $fromName, $toEmail, $emailTitle);

        return View::make("designer.mydesigns")->with("designs", $designs);
    }*/

    public function dashboard($id)
    {

        $inprogressDesigns = Collection::where('designer_id', $id)->where('status', 'disabled')->count();

        //return $inprogressDesigns;
        $draftDesigns = Collection::where('designer_id', $id)->where('status', 'draft')->count();
        $publishedDesigns = Collection::where('published', true)->where('status', 'active')->count();
        $underReviewDesigns = Collection::where('published', false)->where('status', 'active')->count();

        $designs = Collection::where('designer_id', $id)->with('designer')->with('collectionImages')->get();

        $designer = Designer::find($id);

        $dataCards = view('designer.dashboardStatistics')->with('inprogressDesigns', $inprogressDesigns)->with("draftDesigns", $draftDesigns)->with("publishedDesigns", $publishedDesigns)->with("underReviewDesigns", $underReviewDesigns)->render();
        $designCards = view('designer.mydesigns')->with('designs', $designs)->render();
        //$orderRows = view('designer.mymyorders')->with('designs', $designs)->render();

        return response()->json(['status'=>201, 'success' => true, 'data'=>["dataCards"=>$dataCards, "designCards"=>$designCards, "designer"=>$designer], 'message'=>'Designer Dashboard loaded successfully'])->setStatusCode(200);


        //return View::make("designer.dashboardStatistics")->with('inprogressDesigns', $inprogressDesigns)->with("draftDesigns", $draftDesigns)->with("publishedDesigns", $publishedDesigns)->with("underReviewDesigns", $underReviewDesigns);
    }

    public function store(DesignerStoreRequest $request)
    {
        Log::info("in store method");

/*
        $validator = Validator::make($request->all(), [
            'shop' => 'required',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|unique:customers',
            'phone' => array('required', 'regex:/^(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([0-9]{3})\s*\)|([0-9]{3}))\s*(?:[.-]\s*)?([0-9]{3})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$/'),
            'password' => 'required|string',
            'confirm_password' => 'required|same:password',
            'website_url' => 'url',
            'resume' => 'required',
            'portfolio' => 'required'
        ]);


        //$validator = Validator::make($request->all(), $rules);

        // Validate the input and return correct response
        if ($validator->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()
            ), 422);
        }
*/


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
            $success_message = "Designer Account Created successfully";
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


            if (!empty($resume)) {
                //Display File Name
                $resumeFileName = $resume->getClientOriginalName();

                //Move Uploaded File
                $destinationPath = public_path() . '/uploads/designer/resume/';
                $resume->move($destinationPath, $resume->getClientOriginalName());
            }

            if (!empty($portfolio)) {
                //Display File Name
                $portfolioFileName = $portfolio->getClientOriginalName();

                //Move Uploaded File
                $destinationPath = public_path() . '/uploads/designer/portfolio/';
                $portfolio->move($destinationPath, $portfolio->getClientOriginalName());
            }

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
                            "value" => "uploads/user/resume/" . $resumeFileName,
                            "value_type" => "string",
                            "namespace" => "global"

                        ], [
                            "key" => "portfolio",
                            "value" => "uploads/user/portfolio/" . $portfolioFileName,
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
                    'resume' => $resumeFileName,
                    'portfolio' => $portfolioFileName,
                    'tag' => $request->tag,
                    'bio' => $request->bio,
                    'quote' => $request->quote,
                    'business_name' => $request->business_name,
                    'business_address' => $request->business_address,
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

    public function inProgress(){
        $designs  = Collection::where('status', 'disabled')->get();
        $designCards = view('designer.inprogress')->with('designs', $designs)->render();

        return response()->json(['status'=>201, 'success' => true, 'data'=>["designCards"=>$designCards], 'message'=>'Inprogress designs loaded successfully'])->setStatusCode(200);
    }

    public function draft(){
        $designs  = Collection::where('status', 'disabled')->get();
        $designCards = view('designer.draft')->with('designs', $designs)->render();

        return response()->json(['status'=>201, 'success' => true, 'data'=>["designCards"=>$designCards], 'message'=>'Draft designs loaded successfully'])->setStatusCode(200);
    }

    public function published(){
        $designs  = Collection::where('status', 'disabled')->get();
        $designCards = view('designer.published')->with('designs', $designs)->render();

        return response()->json(['status'=>201, 'success' => true, 'data'=>["designCards"=>$designCards], 'message'=>'published designs loaded successfully'])->setStatusCode(200);
    }

    public function under_review(){
        $designs  = Collection::where('status', 'disabled')->get();
        $designCards = view('designer.under_review')->with('designs', $designs)->render();

        return response()->json(['status'=>201, 'success' => true, 'data'=>["designCards"=>$designCards], 'message'=>'Designs under review loaded successfully'])->setStatusCode(200);
    }

    public function allDesigns(){
        $designs  = Collection::all();
        $designCards = view('designer.mydesigns')->with('designs', $designs)->render();

        return response()->json(['status'=>201, 'success' => true, 'data'=>["designCards"=>$designCards], 'message'=>'All designs loaded successfully'])->setStatusCode(200);
    }

    public function createDesign($id){
        $design = Collection::with(['designer', 'collectionImages','bluePrintImages','colorPallettes','products', 'products.productImages'])->find($id);
        //return $design->products;

        $design = view('designer.createDesign')->with('design', $design)->render();

        return response()->json(['status'=>201, 'success' => true, 'data'=>["design"=>$design], 'message'=>'Design loaded successfully'])->setStatusCode(200);

    }

    public function viewDesign($id)
    {
        Log::info('collection id'. $id);
        $design = Collection::where('id', $id)->with('designer', 'collectionImages','bluePrintImages','colorPallettes','products', 'products.productImages')->get();

        $design = view('designer.viewDesign')->with('design', $design)->render();

        return response()->json(['status'=>200, 'success' => true, 'data'=>["design"=>$design], 'message'=>'Design loaded successfully'])->setStatusCode(200);
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

            $productImagesArr = [];
            if ($request->hasfile('products_images')) {
                Log::info("has file collection images");
                foreach ($productImages as $productImage) {
                    Log::info("single collection img");
                    $productImageFileName = $productImage->getClientOriginalName();
                    //Move Uploaded File
                    $destinationPath = public_path() . '/uploads/collection/product_images';
                    $productImage->move($destinationPath, $productImageFileName);

                    $data = [
                        "src" => $productImageFileName
                    ];
                    array_push($productImagesArr, $data);
                }
            }


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
                    "presentment_prices" => [
                        [
                            "price" => [
                                "currency_code" => "USD",
                                "amount" => $request->product_price
                            ],
                            "compare_at_price" => $request->compare_at_price
                        ]
                    ],
                    "images" => $productImagesArr
                ]
            ];

            $result = $api->rest('PUT', '/admin/products/'.$request->product_id.'.json', $data)['body'];
            Log::info('result' . json_encode($result));
            if (isset($result['product'])) {

                $product = Product::where('id', $request->product_id)->update([
                   // 'id' => $result['product']['id'],
                    'collection_id' => $collection->id,
                    'title' => $request->merchandise,
                    'description' => $request->product_description,
                    'size_specification' => $request->size_specification,
                    'product_url' => $request->product_url,
                    'product_price' => $request->product_price,
                    'product_compare_at_price' => $request->compare_at_price,
                    'product_quantity' => $request->quantity,
                    //'status' => "draft"
                ]);

                ProductImages::where('product_id', $request->product_id)->delete();

                foreach ($productImagesArr as $productImage) {
                    ProductImages::create([
                        'product_id' => $request->product_id,
                        'img_src' => $productImage['src'],
                        'img_alt' => $productImage['src'],
                    ]);
                }



                $product = Product::find($request->product_id);
                Log::info('final product' . json_encode($product));

                $products = view('designer.newProduct')->with('product', $product)->with('customer', $customer)->with('collection', $collection)->render();
                return response()->json(['status'=>200, 'success' => true, 'data'=>["products"=>$products], 'message'=>'Product updated successfully'])->setStatusCode(200);

                //return View::make('designer.newProduct')->with('product', $product);

               // return response()->json(['statu' => 201, "data" => $result, "message" => "Product added successfully"])->setStatusCode(201);
            } else {
                return response()->json(['status' => 500, 'errors' => $result]);
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return response()->json(['status' => 422, "errors" => $e->getMessage()])->setStatusCode(422);
        }
    }


    public function updateDesign(CollectionStoreRequest $request)
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

            Log::info('collection_images'. json_encode($collectionImages));


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
            $designGuideFileName = "";

            $design_implementation_guide = $request->design_implementation_guide;
            if (!empty($design_implementation_guide)) {
                //Display File Name
                $designGuideFileName = $design_implementation_guide->getClientOriginalName();

                //Move Uploaded File
                $destinationPath = public_path() . '/uploads/collection/design_implementation_guide/';
                $design_implementation_guide->move($destinationPath, $design_implementation_guide->getClientOriginalName());
            }

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
                [
                    "key" => "dig",
                    "value" => $designGuideFileName,
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

            if (isset($result['smart_collection'])) {

                $collection = Collection::where('id', $request->collection_id)->update([
                   // 'id' => $result['smart_collection']['id'],
                    'design_name' => $request->design_name,
                    'designer_id' => $request->customer_id,
                    'implementation_guide_description' =>           $request->implementation_guide_description,
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

                Log::info('collection ' . json_encode($collection));


                CollectionImages::where('collection_id', $request->collection_id)->delete();
                CollectionBluePrints::where('collection_id', $request->collection_id)->delete();
                CollectionColorPallettes::where('collection_id', $request->collection_id)->delete();

                if ($request->hasfile('collection_images')) {
                     Log::info("has file collection images");
                    foreach ($collectionImages as $collectionImage) {
                        Log::info("single collection img");
                        $collectionImageFileName = $collectionImage->getClientOriginalName();
                        //Move Uploaded File
                        $destinationPath = public_path() . '/uploads/collection/images/';
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
                        $collectionBluePrintFileName = $collectionBluePrint->getClientOriginalName();
                        //Move Uploaded File
                        $destinationPath = public_path() . '/uploads/collection/blueprints/';
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
                            $imgFileName = $file->getClientOriginalName();
                            $destinationPath = public_path() . '/uploads/collection/color_pallates/';
                            $file->move($destinationPath, $imgFileName);
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

                return response()->json(['status' => 200, 'message' => "Room details updated successfully", "data" => $result])->setStatusCode(200);
            } else {
                return response()->json(['status' => 500, 'errors' => $result])->setStatusCode(422);
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return response()->json(['status' => 422, "message" => $e->getMessage()])->setStatusCode(422);
        }
    }


}

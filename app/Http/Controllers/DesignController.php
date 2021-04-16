<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Log;
use App\Collection;
use App\CollectionImages;
use App\CollectionBluePrints;
use App\CollectionRule;
use App\ProductTag;
use App\ProductImages;
use App\ProductVariant;
use App\Product;
use Osiset\BasicShopifyAPI\Options;
use Osiset\BasicShopifyAPI\BasicShopifyAPI;
use Osiset\BasicShopifyAPI\Session;
use App\User;
use App\Customer;
use App\Designer;
use View;
use App\CollectionColorPallettes;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CollectionStoreRequest;
use App\Http\Requests\ProductStoreRequest;
use Carbon\Carbon;

class DesignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $designs = Collection::with(['designer', 'collectionImages'])->where('status', 'approved')->get();
       $designs = Collection::with(['designer', 'collectionImages'])->get();

       $grouped = $designs->groupBy('room_style');
//       $designers = Designer::where('status','approved')->get();
       $designers = Designer::all();



        $designs = view('design.gallery')->with('designGroups', $grouped)->render();

        $datalist = view('design.datalist')->with('designers', $designers)->render();

        return response()->json(['status'=>200, 'success' => true, 'data'=>["designs"=>$designs, "datalist"=>$datalist], 'message'=>'Designs loaded successfully'])->setStatusCode(200);
    }

    public function viewAllByType($type)
    {
        $designs = Collection::with('collectionImages')->where('room_style', $type)->get();
        // return $designs;

        $designers = Customer::where('tag', 'role:designer')
            ->where('status', 'active')
            ->get();


        return View::make('design.view_all')->with("designs", $designs)
            ->with("designers", $designers);
    }

    public function searchDesign(Request $request)
    {
        Log::info('data ' . json_encode($request->all()));


       $sort = 'asc';
        if ($request->Input("params.sorts")) {
            $sort = $request->Input("params.sorts");
        }

        Log::info('request '. $request->max);

        $designs = Collection::with(['designer', 'collectionImages', 'bluePrintImages', 'colorPallettes', 'products', 'products.productImages'])->whereHas('designer', function ($q) use ($request) {
            if ($request->Input("designer")) {
                $q->where('designer_id', $request->Input("designer"));
            }
            if ($request->Input("room_style")) {
                $q->where('collections.room_style', $request->Input("room_style"));
            }
            if ($request->Input("room_type")) {
                $q->where('collections.room_type', $request->Input("room_type"));
            }
            Log::info('request '. $request->max);
            if ($request->Input("max")) {
                $min = (int)$request->Input("min");
                $max = (int)$request->Input("max");
                $q->whereBetween('collections.room_budget', array($min,$max));
            }
        })->orderBy('created_at', $sort)->get();
            $grouped = $designs->groupBy('room_style');

            $designs = view('design.gallery')->with('designGroups', $grouped)->render();

            return response()->json(['status'=>200, 'success' => true, 'data'=>["designs"=>$designs], 'message'=>'Designs loaded successfully'])->setStatusCode(200);
    }

    public function ourDesigns(Request $request)
    {
        $ourDesigns = Collection::get('room_type', $request->type)->get();
        return View::make('design.gallery')->with("traditionalDesigns", $traditionalDesigns);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CollectionStoreRequest $request)
    {
        //Log::info("data " . json_encode($request->all()));


        // $this->validate($request, [
        //     'design_name' => 'required|unique:collections',
        //     'design_price' => 'required',
        //     'room_budget' => 'required|string',
        //     'room_type' => 'required|not_in:0',
        //     'room_style' => 'required|not_in:0',
        //     'implementation_guide_description' => 'required',
        //     'customer_id' => 'required',
        // ]);

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

            Log::info('collection_images' . json_encode($collectionImages));


            $collectionBluePrints = $request->file('collection_blue_prints');
            $colorNames = $request->color_name;
            $colorBrand = $request->brand;
            $colorFinish = $request->finish;
            $colorApplication = $request->application;

            $room_width = $request->width_in_feet . "' " . $request->width_in_inches;
            $room_height = $request->height_in_feet . "' " . $request->height_in_inches;


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


            $data = [
                "smart_collection" => [
                    "title" => $request->design_name,
                    "published" => false,
                    "metafields" => $collectionMetafields,
                    "rules" => [
                        $collectionRule
                    ],
                ]

            ];

            $result = $api->rest('POST', '/admin/smart_collections.json', $data)['body'];

            $current_time = Carbon::now()->timestamp;

            Log::info("current_time" . json_encode($current_time));

            if (isset($result['smart_collection'])) {

                $designGuideFileName = "";

                $design_implementation_guide = $request->design_implementation_guide;
                if (!empty($design_implementation_guide)) {
                    //Display File Name

                    $name = $current_time . '_' . $design_implementation_guide->getClientOriginalName();

                    //Move Uploaded File
                    $destinationPath = public_path() . '/uploads/collection/' . $result['smart_collection']['id'] . '/';
                    $design_implementation_guide->move($destinationPath, $name);
                    $designGuideFileName = $name;
                }

                $collection = Collection::create([
                    'id' => $result['smart_collection']['id'],
                    'design_name' => $request->design_name,
                    'designer_id' => $request->customer_id,
                    'implementation_guide_description' => $request->implementation_guide_description,
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


                if ($request->hasfile('collection_images')) {
                    Log::info("has file collection images");
                    foreach ($collectionImages as $collectionImage) {
                        Log::info("single collection img");
                        $collectionImageFileName = $current_time . '_' . $collectionImage->getClientOriginalName();
                        //Move Uploaded File
                        $destinationPath = public_path() . '/uploads/collection/' . $collection->id.'/';
                        $collectionImage->move($destinationPath, $collectionImageFileName);

                        CollectionImages::create([
                            'collection_id' => $collection->id,
                            'img_src' => $collectionImageFileName,
                            'img_alt' => $collectionImageFileName,
                        ]);
                    }
                }

                if ($request->hasfile('collection_blue_prints')) {
                    Log::info("has file collection blue prints");
                    foreach ($collectionBluePrints as $collectionBluePrint) {
                        Log::info("single blue print img");
                        $name = $current_time . '_' . $collectionBluePrint->getClientOriginalName();
                        //Move Uploaded File
                        $destinationPath = public_path() . '/uploads/collection/' . $collection->id. '/';
                        $collectionBluePrint->move($destinationPath, $name);

                        $collectionBluePrintFileName = $name;
                        CollectionBluePrints::create([
                            'collection_id' => $collection->id,
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
                            $destinationPath = public_path() . '/uploads/collection/' . $collection->id.'/';
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
                            'collection_id' => $collection->id,
                            'color_img' => $color_img_value,
                            'color_name' => $colorNames[$i],
                            'brand' => $colorBrand[$i],
                            'finish' => $colorFinish[$i],
                            'application' => $colorApplication[$i]
                        ]);
                    }
                }

                return response()->json(['status' => 201, 'message' => "Room details saved successfully", "data" => $result])->setStatusCode(201);
            } else {
                return response()->json(['status' => 500, 'errors' => $result])->setStatusCode(422);
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return response()->json(['status' => 422, "message" => $e->getMessage()])->setStatusCode(422);
        }
    }

    public function uploadProducts(ProductStoreRequest $request)
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




            $data = [
                "product" => [
                    "title" => $request->merchandise,
                    "product_type" => '',
                    "description" => $request->product_description,
                    "published" => false,
                    "inventory_quantity" => $request->quantity,
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
                    // "images" => $productImagesArr
                ]
            ];

            $result = $api->rest('POST', '/admin/products.json', $data)['body'];
            Log::info('result' . json_encode($result));
            if (isset($result['product'])) {

                $product = Product::create([
                    'id' => $result['product']['id'],
                    'collection_id' => $collection->id,
                    'vendor_id' => $request->vendor_id,
                    'title' => $request->merchandise,
                    'description' => $request->product_description,
                    'size_specification' => $request->size_specification,
                    'product_url' => $request->product_url,
                    'product_price' => $request->product_price,
                    'product_compare_at_price' => $request->compare_at_price,
                    'product_quantity' => $request->quantity,
                    'status' => "draft"
                ]);

                $current_time = Carbon::now()->timestamp;

                Log::info("current_time" . json_encode($current_time));

                /*$display_picture = $request->file('products_image');
                if (!empty($display_picture)) {
                    //Display File Name
                    $imgFileName = $display_picture->getClientOriginalName();

                    //Move Uploaded File
                    $destinationPath = public_path() . '/uploads/user/display_picture';
                    $display_picture->move($destinationPath, $display_picture->getClientOriginalName());
                }*/

                if ($request->hasfile('product_images')) {
                    Log::info("has file product_images");
                    foreach ($productImages as $productImage) {
                        Log::info("single product img");
                        $productImageFileName = $current_time . '_' . $productImage->getClientOriginalName();
                        //Move Uploaded File
                        $destinationPath = public_path() . '/uploads/collection/'.$collection->id. '/';
                        $productImage->move($destinationPath, $productImageFileName);

                       ProductImages::create([
                            'product_id' => $product->id,
                            'img_src' => $productImageFileName,
                            'img_alt' => $productImageFileName,
                        ]);
                    }
                }

                $products = Product::with('vendor','productImages')->where('collection_id', $collection->id)->get();


                Log::info('final product' . json_encode($product));

                $products = view('designer.newProduct')->with('products', $products)->with('customer', $customer)->with('collection', $collection)->render();

                return response()->json(['status' => 201, 'success' => true, 'data' => ["products" => $products], 'message' => 'Merchandise added successfully'])->setStatusCode(201);

                //return View::make('designer.newProduct')->with('product', $product);

                // return response()->json(['statu' => 201, "data" => $result, "message" => "Merchandise added successfully"])->setStatusCode(201);
            } else {
                return response()->json(['status' => 500, 'errors' => $result]);
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return response()->json(['status' => 422, "errors" => $e->getMessage()])->setStatusCode(422);
        }
    }

    public function bulkUpload(Request $request)
    {
        $this->validate($request, [
            'upload_product_csv' => 'required',
            'customer_id' => 'required',
            'collection_id' => 'required',
        ]);
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

        $file = $request->file('upload_product_csv');

        // File Details
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath();
        $fileSize = $file->getSize();
        $mimeType = $file->getMimeType();

        // Valid File Extensions
        $valid_extension = array("csv");

        // 2MB in Bytes
        $maxFileSize = 2097152;

        // Check file extension
        if (in_array(strtolower($extension), $valid_extension)) {

            // Check file size
            if ($fileSize <= $maxFileSize) {

                // File upload location
                $location = 'uploads';

                // Upload file
                $file->move($location, $filename);

                // Import CSV to Database
                $filepath = public_path($location . "/" . $filename);

                // Reading file
                $file = fopen($filepath, "r");

                $importData_arr = array();
                $i = 0;

                while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                    $num = count($filedata);


                    for ($c = 0; $c < $num; $c++) {
                        $importData_arr[$i][] = $filedata[$c];
                    }
                    $i++;
                }
                fclose($file);

                // Insert to MySQL database

                $productIds = [];

                unset($importData_arr[0]);
                foreach ($importData_arr as $importData) {

                    Log::info("import Data" . json_encode($importData));
                    $data = [
                        "product" => [
                            "title" => $importData[0],
                            "product_type" => '',
                            "description" => $importData[1],
                            "published" => false,
                            "inventory_quantity" => $importData[6],
                            "tags" => [
                                $collection->design_name,
                            ],
                            "presentment_prices" => [
                                [
                                    "price" => [
                                        "currency_code" => "USD",
                                        "amount" => $importData[4]
                                    ],
                                    "compare_at_price" => $importData[5]
                                ]
                            ],

                        ]
                    ];

                    $result = $api->rest('POST', '/admin/products.json', $data)['body'];
                    Log::info('result' . json_encode($result));

                    if (isset($result['product'])) {

                        $product = Product::create([
                            'id' => $result['product']['id'],
                            'collection_id' => $collection->id,
                            'title' => $importData[0],
                            'description' => $importData[1],
                            'size_specification' => $importData[2],
                            'product_url' => $importData[3],
                            'product_price' => $importData[4],
                            'product_compare_at_price' => $importData[5],
                            'vendor_id' => $importData[6],
                            'product_quantity' => $importData[7],
                            'status' => "draft"
                        ]);

                        array_push($productIds, $product->id);
                    }
                }

                if ($productIds) {
                    $products = Product::with('vendor,productImages')->where('collection_id', $collection->id)->get();
                    $products = view('designer.newProduct')->with('products', $products)->with('customer', $customer)->with('collection', $collection)->render();
                    return response()->json(['status' => 201, 'success' => true, 'data' => ["products" => $products], 'message' => 'Merchandise bulk upload added successfully'])->setStatusCode(201);
                } else {
                    return response()->json(['status' => 500, 'errors' => $result]);
                }
            } else {
                return response()->json(['status' => 500, 'errors' => "data"]);
            }
        } else {
            return response()->json(['status' => 500, 'errors' => ["upload_product_csv" => "Invalid file extension"]]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return "show design". $id;
        Log::info('collection id' . $id);
        $design = Collection::where('id', $id)->with('customer', 'collectionImages', 'bluePrintImages', 'colorPallettes', 'products', 'products.productImages')->get();

        //return  $design;
        return View::make('designer.viewDesign')->with("design", $design);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function verifyDesignName(Request $request)
    {
        $this->validate($request, [
            'design_name' => 'required',
        ]);

        $design = Collection::where('design_name', $request->design_name)->get();
        if ($design->isEmpty()) {
            return response()->json(["success" => ["design_name" => "design_name verified successfully"]])->setStatusCode(200);

            //Log::info("email not exist". json_encode($customer));
        } else {
            return response()->json(["errors" => ["design_name" => "design_name has already taken"]])->setStatusCode(422);
        }
        Log::info("design" . json_encode($design));
    }

    public function verifyProductName(Request $request)
    {
        $this->validate($request, [
            'merchandise' => 'required',
        ]);
    }

    public function submitDesign(Request $request)
    {
        $this->validate($request, [
            'collection_id' => 'required',
        ]);

        $collection = Collection::find($request->collection_id);
        $collection->status = 'submitted';
        $collection->save();

        $products = Product::where('collection_id', $collection->id)->get();
        foreach ($products as $product) {
            $product->status = "submitted";
            $product->save();
        }

        return response()->json(["status" => 200, "message" => "design submitted successfully"])->setStatusCode(200);
    }

    public function removeDesign($id, $designerId)
    {
        $collection = Collection::where('designer_id', $designerId)->find($id);
        $products = Product::where('collection_id', $id)->get();
        $shop = User::where('name', env('Shop_NAME'))->first();
        $options = new Options();
        $options->setVersion('2021-01');
        $api = new BasicShopifyAPI($options);
        $api->setSession(new Session($shop->name, $shop->password));
        $result = $api->rest('DELETE', '/admin/smart_collections/'.$id.'.json')['body'];
        $productImages = ProductImages::where('product_id', $products->first()->id)->delete();

        //$productImages = ProductImages::where('product_id', $products->first()->id)->delete();
        foreach($products as $product){
            $result = $api->rest('DELETE', '/admin/products/'.$product->id.'.json')['body'];
            $product->delete();
        }

        if($collection){
            CollectionImages::where('collection_id', $id)->delete();
            CollectionBluePrints::where('collection_id', $id)->delete();
            CollectionColorPallettes::where('collection_id', $id)->delete();
            $collection->delete();
            return response()->json(["status" => 200, "message" => "design removed successfully"])->setStatusCode(200);

        }else{
            return response()->json(["status" => 400, "message" => "design not found"])->setStatusCode(400);
        }

    }
}

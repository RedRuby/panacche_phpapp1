<?php

namespace App\Jobs;

use App\CSVBulkUpload;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Collection;
use App\ProductImages;
use App\Product;
use App\User;
use App\Vendor;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Osiset\BasicShopifyAPI\Options;
use Osiset\BasicShopifyAPI\BasicShopifyAPI;
use Osiset\BasicShopifyAPI\Session;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManagerStatic as Image;

class ProductBulkUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info("started job handle method");
        try{
            $shop_name = env('Shop_NAME');
            $shop = User::where('name', $shop_name)->first();
            $options = new Options();
            $options->setVersion('2021-01');
            $api = new BasicShopifyAPI($options);
            $api->setSession(new Session($shop->name, $shop->password));

                $csvFile = CSVBulkUpload::where('status', 'pending')->first();

                if($csvFile){
                    $filepath = 'uploads/csv/'.$csvFile->file_name;
                    $csvFile->status = 'started_uploading';
                    $csvFile->save();

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
                $collection = Collection::find($csvFile->collection_id);

                unset($importData_arr[0]);
                foreach ($importData_arr as $importData) {
                    Log::info("row ". json_encode($importData));
                    $vendor_name = "";
                    $vendor_id = "";
                    if($importData[5]){
                        $vendor_name = strtolower(trim($importData[5]));
                        $vendor = Vendor::whereRaw('LOWER(vendor_name) = ?', $vendor_name)->first();
                        Log::info("got vendor " . json_encode($vendor));
                        if($vendor){
                            $vendor_name = $vendor->vendor_name;
                            $vendor_id = $vendor->id;
                            Log::info("vendor found " . json_encode($vendor));
                        }else{
                            $vendor = Vendor::create([
                                'vendor_name' => $vendor_name,
                                'vendor_logo' => " "
                            ]);
                            $vendor_name = $vendor->vendor_name;
                            $vendor_id = $vendor->id;
                            Log::info("New vendor created " . json_encode($vendor));
                        }
                    }
                    $images =[];
                    $productImageFileName = "";
                    if($importData[7]){


                        $productImages  =  $importData[7];
                        $current_time = Carbon::now()->timestamp;
                        if($productImages){
                            $productImages = explode(",", $productImages);
                            if(count($productImages) > 1){
                                Log::info("in the product image array");
                                foreach($productImages as $productImage){
                                    $contents = file_get_contents($productImage);
                                    $productImageFileName = basename($productImage);

                                 //  chmod('uploads/collection/' . $collection->id . '/', 777);

                                    $location = public_path('/uploads/collection/' . $collection->id . '/'. $productImageFileName);
                                    Log::info("productImages ". $productImage);
                                    Image::make($productImage)->save($location);
                                    $url = env('APP_URL') .'/uploads/collection/' . $collection->id . '/' . $productImageFileName;


                                    $image = [
                                        "src"=> $url
                                    ];
                                    array_push($images,$image);
                                }
                            }else{
                                Log::info("single  product image ");
                                $productImages  =  $importData[7];
                                $contents = file_get_contents($productImages);
                                $productImageFileName = basename($productImages);

                               // chmod('uploads/collection/' . $collection->id . '/', 0755, true);
                                $location = public_path('/uploads/collection/' . $collection->id . '/'. $productImageFileName);
                                $path = $productImages;
                                Log::info("productImages ". $path);
                                Image::make($path)->save($location);
                                $url = env('APP_URL') .'/uploads/collection/' . $collection->id . '/' . $productImageFileName;

                                $image = [
                                    "src"=>  $url
                                ];
                                array_push($images,$image);
                            }

                        }
                    }

                    // $productTags = $importData[8];
                    // $product_Tags = [];
                    // array_push($product_Tags,$collection->design_name);
                    // if($productTags){
                    //      if($productTags){
                    //         $productTags = explode(",",$productTags);

                    //         if(count($productTags) > 1){
                    //             foreach($productTags as $productTag){

                    //                 array_push($product_Tags,$productTag);
                    //             }
                    //         }else{
                    //             $productTags = $importData[8];
                    //             array_push($product_Tags,$productTags);
                    //         }
                    //     }
                    // }

                    sleep(5);

                    Log::info("my images : ". json_encode($images));

                    Log::info("import Data" . json_encode($importData));
                    $data = [
                        "product" => [
                            "title" => $importData[0],
                            "vendor" => $vendor_name,
                            "product_type" => '',
                            "description" => $importData[1],
                            "published" => false,
                            "inventory_quantity" => $importData[6],
                            //"tags" => $product_Tags,
                            "variants" => [
                                [
                                    "option1" => "Default Title",
                                    "price" => $importData[4],
                                    "inventory_quantity" => $importData[6],
                                ],
                            ],
                            "images" => $images,
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
                            'vendor_id' => $vendor_id,
                            'product_quantity' => $importData[6],
                            'status' => "draft"
                        ]);

                        Log::info("productImageFileName img ". $productImageFileName);
                        $productImages  =  $importData[7];
                        $productImages = explode(",", $productImages);
                        if(count($productImages) > 1){
                            foreach($productImages as $key=>$productImage){
                                    Log::info("in productImageFileName");
                                    ProductImages::create([
                                        'product_id' => $product->id,
                                        'img_src' => $productImageFileName,
                                        'img_alt' => $productImageFileName,
                                    ]);
                            }
                        }else{
                            $productImages  =  $importData[7];
                            if($productImages){
                                ProductImages::create([
                                    'product_id' => $product->id,
                                    'img_src' => $productImageFileName,
                                    'img_alt' => $productImageFileName,
                                ]);
                            }
                        }


                        array_push($productIds, $product->id);
                    }
                }

            }


        }catch(\Exception $e) {
            Log::info($e->getMessage());
           // return response()->json(['status' => 422, "errors" => $e->getMessage()])->setStatusCode(422);
        }
    }
}

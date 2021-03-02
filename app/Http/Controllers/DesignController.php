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


class DesignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        Log::info("data " . json_encode($request));
        $this->validate($request, [
            'design_name' => 'required',
            'room_budget' => 'required|string',
            'room_type' => 'required',
            'room_style' => 'required',
            'implementation_guide_description' => 'required',
            'product_name.*' => 'required',
        ]);

        $shop = User::where('name', $request->shop)->first();
        $options = new Options();
        $options->setVersion('2021-01');
        $api = new BasicShopifyAPI($options);
        $api->setSession(new Session($shop->name, $shop->password));


        $collectionImages = count($request->collection_image);
        $collectionBluePrints = count($request->collection_blue_print);
        $colorPlates = count($request->color_plates);
        $collectionImage = $request->room_image;
        $products = count($request->product_name);
        $productImages = count($request->product_images);
        $productTags = count($request->product_tag);
        $productVariant = count($request->product_tag);
        $collectiomImageName = "";
        $collectiomImageSrc = "";


        $collectionRule = [
            "column" => "tag",
            "relation" => "equals",
            "condition" => $request->design_name,
        ];

        $collectionMetafields = [
            [
                "key" => "description",
                "value" => $request->location,
                "value_type" => "string",
                "namespace" => "gloabal",
            ],
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
                "key" => "description",
                "value" => $request->implementation_guide_description,
                "value_type" => "string",
                "namespace" => "gloabal",
            ],

        ];


        if ($collectionImage) {
            $imgFileName = $collectionImage->getClientOriginalName();
            //Move Uploaded File
            $destinationPath = public_path() . '/uploads/collection/images/';
            $collectionImage->move($destinationPath, $collectionImage->getClientOriginalName());

            $collectiomImageName = $imgFileName;
            $collectiomImageSrc = $destinationPath;
        }

        $collectionImage = [
            "src" => $collectiomImageSrc,
            "alt" => $collectiomImageName
        ];

        $data = [
            "smart_collection" => [
                "title" => $request->design_name,
                "published" => false,
                "metafields" => [
                    $collectionMetafields
                ],
                "rules" => [
                    $collectionRule
                ],
                "image" => $collectionImage,
            ]

        ];

        $result = $api->rest('POST', '/admin/smart_collections.json', $data)['body']['smart_collection'];

        if ($result) {
            $collection = Collection::create([
                'title' => $request->design_name,
                'description' => $request->description,
                'image_src' => $request->image_src,
                'image_alt' => $request->image_alt,
                'room_type' => $request->room_type,
                'room_style' => $request->room_style,
                'room_budget' => $request->room_budget,
            ]);

            if ($collectionImages) {
                $collectiomImagesData = [];
                for ($i = 0; $i < count($collectionImages); $i++) {
                    $imgFileName = $collectionImages[$i]->getClientOriginalName();
                    //Move Uploaded File
                    $destinationPath = public_path() . '/uploads/collection/images/';
                    $collectionImages[$i]->move($destinationPath, $collectionImages[$i]->getClientOriginalName());
                    $data = [
                        'collection_id' => $collection->id,
                        'img_src' => $destinationPath,
                        'img_alt' => $imgFileName,
                    ];
                    array_push($collectiomImagesData, $data);
                    if ($i == count($collectionImages) - 1) {
                        Log::info("collectiomImagesData -----" . json_encode($collectiomImagesData));
                        CollectionImages::insert($collectiomImagesData);
                    }
                }
            }

            if ($collectionBluePrints) {
                $collectionBluePrintsData = [];
                for ($j = 0; $j < count($collectionBluePrints); $j++) {
                    $imgFileName = $collectionBluePrints[$j]->getClientOriginalName();
                    //Move Uploaded File
                    $destinationPath = public_path() . '/uploads/collection/images/';
                    $collectionBluePrints[$j]->move($destinationPath, $collectionBluePrints[$j]->getClientOriginalName());
                    $data = [
                        'collection_id' => $collection->id,
                        'img_src' => $destinationPath,
                        'img_alt' => $imgFileName,
                    ];
                    array_push($collectionBluePrintsData, $data);
                    if ($i == count($collectionBluePrints) - 1) {
                        Log::info("collectionBluePrintsData -----" . json_encode($collectionBluePrintsData));
                        CollectionBluePrints::insert($collectionBluePrintsData);
                    }
                }
            }


            if ($products) {
                for ($k = 0; $k < count($products); $k++) {
                    $product = Product::create([
                        'title' => $products[$k]['title'],
                        'description' => $products[$k]['description'],
                        'body' => $products[$k]['body'],
                        'vendor' => $products[$k]['vendor'],
                        'product_type' => $products[$k]['product_type'],
                        'room_type' => $products[$k]['room_type'],
                        'room_style' => $products[$k]['room_style'],
                        'room_budget' => $products[$k]['room_budget'],
                    ]);

                    //$productImages = $products[$i]['images'];
                    if ($productImages) {
                        $productImagesData = [];
                        for ($l = 0; $l < count($productImages); $l++) {
                            $imgFileName = $productImages[$i]->getClientOriginalName();
                            //Move Uploaded File
                            $destinationPath = public_path() . '/uploads/collection/images/';
                            $productImages[$l]->move($destinationPath, $productImages[$l]->getClientOriginalName());
                            $data = [
                                'product_id' => $product->id,
                                'img_src' => $destinationPath,
                                'img_alt' => $imgFileName
                            ];
                            array_push($productImagesData, $data);
                            if ($l == count($productImages) - 1) {
                                Log::info("productImagesData -----" . json_encode($productImagesData));
                                ProductImages::insert($productImagesData);
                            }
                        }
                    }

                    if ($productVariant) {
                        $productVariantsData = [];
                        for ($m = 0; $m < count($productVariant); $m++) {

                            $data = [
                                'product_id' => $product->id,
                                'option_name' => $productVariant[$m]['option_name'],
                                'option_value' => $productVariant[$m]['option_value'],
                                'price' => $productVariant[$m]['price'],
                            ];
                            array_push($productVariantsData, $data);
                            if ($i == count($productVariant) - 1) {
                                Log::info("productImagesData -----" . json_encode($productImagesData));
                                ProductVariant::insert($productImagesData);
                            }
                        }
                    }
                }
            }
        } else {
            return response()->json(['status' => 500, 'message' => 'something went wrong!']);
        }
    }

    public function collectionExist($title)
    {
        $collection = Collection::where('title', $title)->get();
        if ($collection) {
            return response()->json(["status" => 422, "message" => "Design name already taken"]);
        } else {

            return response()->json(["status" => 200, "message" => "Collection not found"]);
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
        //
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
}

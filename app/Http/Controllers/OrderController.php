<?php

namespace App\Http\Controllers;

use App\MyProject;
use App\UserDesignerRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Collection;
use App\CollectionBluePrints;
use App\CollectionColorPallettes;
use App\CollectionImages;
use App\CollectionRule;
use App\MyProjectsCollection;
use App\Product;
use App\MyProjectsCollectionBluePrints;
use App\MyProjectsCollectionColorPallettes;
use App\MyProjectsCollectionImages;
use App\MyProjectsCollectionRules;
use App\Order;

class OrderController extends Controller
{
    public function orderCreation(Request $request)
    {
        $request_data = $request->all();
        Log::info("checkout :: inputs :: ".json_encode($request_data));
        $product_id = $request_data['line_items'][0]['product_id'];
        $customer_id = $request_data['customer']['id'];
        $status = 'In Progress';
        $amount = $request_data['total_price'];
        $order_type = 'design_guid';
        $tag = $request_data['tags'].", OT:DesignGuide";
        $created_at = $request_data['created_at'];
        $updated_at = $request_data['updated_at'];
        $fulfillment_status = (!empty($request_data['fulfillments']) && !empty($request_data['fulfillments']['status'])) ? $request_data['fulfillments']['status'] : 'unfulfilled';
        $financial_status = $request_data['financial_status'];
        $shopify_order_data = json_encode($request_data);
        $name = $request_data['name'];
        $product_data = Product::find($product_id)->toArray();
        $collection_id = $product_data['collection_id'];
        $collection_data = Collection::find($collection_id)->toArray();
        $designer_id = $collection_data['designer_id'];
        unset($collection_data['id']);
        unset($collection_data['created_at']);
        unset($collection_data['updated_at']);
        $collection_id_new = MyProjectsCollection::insertGetId($collection_data);
        $order_data = [
            'collection_id' => $collection_id,
            'designer_id' => $designer_id,
            'customer_id' => $customer_id,
            'status' => $status,
            'amount' => $amount,
            'order_type' => $order_type,
            'tag' => $tag,
            'fulfillment_status' => $fulfillment_status,
            'financial_status' => $financial_status,
            'shopify_order_data' => $shopify_order_data,
            'name' => $name,
            'created_at' => $created_at,
            'updated_at' => $updated_at
        ];
        $order_placed = Order::insert($order_data);
        MyProject::insertGetId([
                        'parent_design_id' => $collection_id,
                        'my_project_collection_id' => $collection_id_new,
                        'customer_id'   => $customer_id
                    ]);
        $collection_blue_prints = CollectionBluePrints::where('collection_id',$collection_id)->get()->toArray();
        foreach ($collection_blue_prints as $key=>$collection_blue_print) {
                $collection_blue_prints[$key]['collection_id'] = $collection_id_new;
                unset($collection_blue_prints[$key]['id']);
                unset($collection_blue_prints[$key]['created_at']);
                unset($collection_blue_prints[$key]['updated_at']);
        }
        MyProjectsCollectionBluePrints::insert($collection_blue_prints);

        $collection_color_pallettes = CollectionColorPallettes::where('collection_id',$collection_id)->get()->toArray();
        foreach ($collection_color_pallettes as $key=>$collection_color_pallette) {
                $collection_color_pallettes[$key]['collection_id'] = $collection_id_new;
                unset($collection_color_pallettes[$key]['id']);
                unset($collection_color_pallettes[$key]['created_at']);
                unset($collection_color_pallettes[$key]['updated_at']);
        }
        MyProjectsCollectionColorPallettes::insert($collection_color_pallettes);

        $collection_images = CollectionImages::where('collection_id',$collection_id)->get()->toArray();
        foreach ($collection_images as $key=>$collection_image) {
                $collection_images[$key]['my_projects_collection_id'] = $collection_id_new;
                unset($collection_images[$key]['id']);
                unset($collection_images[$key]['created_at']);
                unset($collection_images[$key]['updated_at']);
                unset($collection_images[$key]['collection_id']);
        }
        MyProjectsCollectionImages::insert($collection_images);

        $collection_rules = CollectionRule::where('collection_id',$collection_id)->get()->toArray();
        foreach ($collection_rules as $key=>$collection_rule) {
                $collection_rules[$key]['collection_id'] = $collection_id_new;
                unset($collection_rules[$key]['created_at']);
                unset($collection_rules[$key]['updated_at']);
        }
        MyProjectsCollectionRules::insert($collection_rules);
    }

    public function orderPlaced(Request $request) {

        $messages = [
            'id.required'       => 'Please provide the customer id.',
            'orderId.required' => 'Please provide the order id.',
        ];

        $validator = Validator::make($request->all(), [
            'id'            => 'required|string',
            'orderId'      => 'required|string',
        ], $messages);

        if($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json(['status' => 0, 'success' => false, 'error' => $error])->setStatusCode(200);
        }

        $products = MyProject::select('products.*', 'my_projects.customer_id', 'my_projects.id as my_project_id', 'designers.first_name', 'designers.last_name', 'designers.display_picture', 'designers.id as designerId', 'my_projects.my_project_collection_id', 'product_images.img_src')
        ->leftJoin('my_projects_collection_products', 'my_projects.id', '=', 'my_projects_collection_products.my_project_id')
        ->leftJoin('products', 'products.id', '=', 'my_projects_collection_products.product_id')
        ->leftJoin('product_images', 'products.id', '=', 'product_images.product_id')
        ->leftJoin('collections', 'collections.id', '=', 'my_projects.parent_design_id')
        ->leftJoin('designers', 'collections.designer_id', '=', 'designers.id')
        ->where('my_projects.customer_id', '=', $request->id)
        ->where('my_projects.id', '=', $request->orderId)->get();

        if(count($products) > 0) {
            foreach ($products as $key => $value) {
                if($value->img_src != '') {

                    if(file_exists(asset('uploads/products/'.$value->id.'/'.$value->img_src))) {
                        $products[$key]->img_src = asset('uploads/products/'.$value->id.'/'.$value->img_src);
                    } else {
                        $products[$key]->img_src = asset('uploads/products/deginer-img.jpeg');
                    }
                }
            }
        }
        Log::info("OrderController :: orderPlaced products :: ".print_r($products, true));

        $rating = UserDesignerRating::where('customer_id', '=', $request->id)->where('designer_id', '=', $products[0]->designerId)->where('my_project_collection_id', $products[0]->my_project_collection_id)->orderBy('id','desc')->first();
        Log::info("OrderController :: orderPlaced rating :: ".print_r($rating, true));

        $order_placed = view('customer.order-placed')->with('products', $products)->with("rating", $rating)->render();
        return response()->json(['status' => 200, 'success' => true, 'data' => ["order_placed" => $order_placed], 'message' => 'My order details loaded successfully.'])->setStatusCode(200);
    }

    public function saveRateAndReview(Request $request) {

        $data['customer_id'] = (isset($request->id) && $request->id !='') ? $request->id : 0;
        $data['designer_id'] = (isset($request->designer_id) && $request->designer_id !='') ? $request->designer_id : 0;
        $data['my_project_collection_id'] = (isset($request->my_project_collection_id) && $request->my_project_collection_id !='') ? $request->my_project_collection_id : 0;
        $data['rating'] = (isset($request->rating) && $request->rating !='') ? $request->rating : 0;
        $data['review'] = (isset($request->review) && $request->review !='') ? $request->review : null;

        $rating = UserDesignerRating::create($data);
        Log::info("OrderController :: saveRateAndReview :: rating :: ".print_r($rating, true));

        return response()->json(['status' => 200, 'success' => true, 'data' => [], 'message' => 'Designer ratings saved successfully.'])->setStatusCode(200);
    }
}

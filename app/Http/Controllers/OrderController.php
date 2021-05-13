<?php

namespace App\Http\Controllers;

use App\MyProject;
use App\UserDesignerRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function orderCreation(Request $request)
    {
        Log::info('order creation: ' . json_encode($request->all()));

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

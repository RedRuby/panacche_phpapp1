<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Designer;
use Illuminate\Support\Facades\Log;
use View;
use App\Collection;
use App\Discount;
use App\Customer;
use Osiset\BasicShopifyAPI\Options;
use Osiset\BasicShopifyAPI\BasicShopifyAPI;
use Osiset\BasicShopifyAPI\Session;
use App\User;

class PagesController extends Controller
{
    public function ourDesigners()
    {
        $designers = Designer::where('status', 'active')->get();
        $designers = view('pages.ourDesigners')->with('designers', $designers)->render();

        return response()->json(['status'=>200, 'success' => true, 'data'=>["designers"=>$designers], 'message'=>'Designers loaded successfully'])->setStatusCode(200);

    }

    public function viewDesigner($id)
    {
        $designer = Designer::find($id);
        $designer = view('pages.view-designer')->with('designer', $designer)->render();

        return response()->json(['status'=>200, 'success' => true, 'data'=>["designer"=>$designer], 'message'=>'Designers loaded successfully'])->setStatusCode(200);

    }

    public function viewDesign($id, $customer, $shop)
    {
        $customer = Customer::find($customer);
        $design = Collection::with('designer', 'collectionImages','bluePrintImages','colorPallettes','products', 'products.productImages', 'products.vendor', 'digitalProduct')->find($id);


       // if($design->digitalProduct){
            $shop = User::where('name', $shop)->first();
            $options = new Options();
            $options->setVersion('2021-01');
            $api = new BasicShopifyAPI($options);
            $api->setSession(new Session($shop->name, $shop->password));


            $result = $api->rest('GET', '/admin/products/'.$design->digitalProduct->id. '/variants.json')['body'];

            Log::info('result' . json_encode($result));

      //  }

        $discount = Discount::first();
        $design = view('pages.design')->with('design', $design)
        ->with('discount', $discount)
        ->with('customer',$customer)
        ->with('variant_id', $result["variants"][0]["id"])->render();

        return response()->json(['status'=>200, 'success' => true, 'data'=>["design"=>$design], 'message'=>'Design loaded successfully'])->setStatusCode(200);

    }
}

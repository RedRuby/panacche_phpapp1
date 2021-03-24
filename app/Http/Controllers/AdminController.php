<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Osiset\BasicShopifyAPI\Options;
use Osiset\BasicShopifyAPI\BasicShopifyAPI;
use Osiset\BasicShopifyAPI\Session;
use View;
use App\Collection;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index()
    {
    }

    public function designers()
    {
        $customers = Customer::where('tag', 'role:designer')
            ->where('status', 'pending')
            ->get();

        return View::make("admin.newDesigners")->with("customers", $customers);
    }//

    public function designs()
    {
        $designs = Collection::where('published', false)->where('status', 'active')->with('customer')->with('collectionImages')->get();

        //return $designs;

        return View::make("admin.newDesigns")->with("designs", $designs);
    }

    public function statistics(){
        $designersCount = Customer::where('tag', 'role:designer')->where('status', 'active')->count();
        $customersCount = Customer::where('tag', 'role:customer')->where('status', 'active')->count();
        $designsCount = Collection::where('published', true)->count();

        return View::make("admin.dashboardStatistics")->with("designersCount", $designersCount)->with("customersCount", $customersCount)->with("designsCount", $designsCount);
    }

    public function viewProfile($id)
    {
        $customer = Customer::find($id);
        return View::make('customer.view')->with("customer", $customer);
    }

    public function viewDesign($id){
        Log::info('collection id'. $id);
        $design = Collection::where('id', $id)->with('customer', 'collectionImages','bluePrintImages','colorPallettes','products', 'products.productImages')->get();

        // foreach($design as $design){
        //     return $design->products();
        // /}

       //return  $design;
       return View::make('admin.viewDesign')->with("design", $design);

    }
}

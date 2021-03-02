<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use View;
use Osiset\BasicShopifyAPI\Options;
use Osiset\BasicShopifyAPI\BasicShopifyAPI;
use Osiset\BasicShopifyAPI\Session;
use View;

class AdminController extends Controller
{
    public function index(){
        $customers = Customer::where('tag', 'role:designer')
                            ->where('status', 'pending')
                            ->get();

        return View::make("admin.dashboard")->with("customers", $customers);
    }

    public function viewProfile($id){
        $customer = Customer::find($id);
        return View::make('customer.view')->with("customer", $customer);
    }
}

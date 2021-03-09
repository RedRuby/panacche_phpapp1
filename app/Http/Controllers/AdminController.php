<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Osiset\BasicShopifyAPI\Options;
use Osiset\BasicShopifyAPI\BasicShopifyAPI;
use Osiset\BasicShopifyAPI\Session;
use View;
use App\Collection;

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
    }

    public function designs()
    {
        $designs = Collection::where('published', false)->get();

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
}

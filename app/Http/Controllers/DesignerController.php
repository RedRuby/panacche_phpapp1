<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Collection;
use View;

class DesignerController extends Controller
{
    public function users($id)
    {
        // $customers = Customer::where('tag', 'role:designer')
        //     ->where('status', 'pending')
        //     ->get();

        // return View::make("admin.newDesigners")->with("customers", $customers);
    }

    public function designs($id)
    {
        $designs = Collection::where('customer_id', $id)->with('collectionImages')->get();
        //return $designs;
        return View::make("designer.mydesigns")->with("designs", $designs);
    }

    public function statistics($id){
        $activeDesigns = Collection::where('customer_id', $id)->where('published', true)->count();
        $designsUnderReview = Collection::where('customer_id', $id)->where('published', false)->count();
        $updateRequest = Collection::where('published', true)->count();
        $notifications = Collection::where('published', true)->count();

        //return "Hello";
        return View::make("designer.dashboardStatistics")->with('activeDesigns', $activeDesigns)->with("designsUnderReview", $designsUnderReview)->with("updateRequest", $updateRequest)->with("notifications", $notifications);
    }
}

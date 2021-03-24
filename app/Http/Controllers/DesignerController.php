<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Collection;
use App\Customer;
use View;
use Mail;
use App\Helpers\Helper;

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
        $designs = Collection::where('customer_id', $id)->with('customer')->with('collectionImages')->get();
        //return $designs;
        $data = ['abc',"xyz","lmn"];
        $template = "emails.mail";
        $subject = "just for testing";
        $fromEmail = "panacchebeta@gmail.com";
        $fromName = "Panacche Team";
        $toEmail = "nileshbari.8085@gmail.com";
        $emailTitle = "Account Creation";

        Helper::sendmail($data, $template, $subject, $fromEmail, $fromName, $toEmail, $emailTitle);

        return View::make("designer.mydesigns")->with("designs", $designs);
    }

    public function statistics($id){
        $activeDesigns = Collection::where('customer_id', $id)->where('published', true)->count();
        $designsUnderReview = Collection::where('customer_id', $id)->where('published', false)->where('status', 'active')->count();
        $updateRequest = Collection::where('published', true)->count();
        $notifications = Collection::where('published', true)->count();

        return View::make("designer.dashboardStatistics")->with('activeDesigns', $activeDesigns)->with("designsUnderReview", $designsUnderReview)->with("updateRequest", $updateRequest)->with("notifications", $notifications);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Designer;
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

    public function newArrivalPendings()
    {
        $designers = Designer::where('status', 'pending')
            ->get();

        $designs = Collection::where('published', false)->where('status', 'active')->with('designer')->with('collectionImages')->get();

            $returnHTML = view('admin.newArrivalPendings')->with('designers', $designers)->with('designs', $designs)->render();

            return response()->json(['status'=>200, 'success' => true, 'data'=>$returnHTML, 'message'=>'New Arrival Pendings'])->setStatusCode(201);

       // return View::make("admin.newArrivalPendings")->with("designers", $designers);
    }

    public function designs()
    {
        $designs = Collection::where('published', false)->where('status', 'active')->with('customer')->with('collectionImages')->get();

        //return $designs;

        return View::make("admin.newDesigns")->with("designs", $designs);
    }

    public function statistics(){
        $newDesignersCount = Designer::where('status', 'pending')->count();
        $newDesignsCount = Collection::where('status', 'pending')->count();
        $newOrdersCount = 0;
        $newSalesCount = 0;


        return View::make("admin.dashboardStatistics")->with("newDesignersCount", $newDesignersCount)->with("newDesignsCount", $newDesignsCount)->with("newOrdersCount", $newOrdersCount)->with("newSalesCount",$newSalesCount);
    }

    public function viewProfile($id)
    {
        $customer = Designer::find($id);
        return View::make('customer.view')->with("customer", $customer);
    }

    public function viewDesign($id)
    {
        Log::info('collection id'. $id);
        $design = Collection::where('id', $id)->with('customer', 'collectionImages','bluePrintImages','colorPallettes','products', 'products.productImages')->get();

        // foreach($design as $design){
        //     return $design->products();
        // /}

       //return  $design;
       return View::make('admin.viewDesign')->with("design", $design);

    }

    public function viewDesignerProfile($id)
    {
        $designer  = Designer::find($id);
        $leftPart = view('designer.profile')->with('designer', $designer)->render();

        return response()->json(['status'=>201, 'success' => true, 'data'=>["leftPart"=>$leftPart], 'message'=>'Designer Profile loaded successfully'])->setStatusCode(200);

    }

    public function approveDesigner($id)
    {
        Log::info('profile id' . $id);
        try {
            $customer = Designer::find($id);
            $customer->status = "active";
            $customer->save();

            return response()->json(["status" => "success", "statusCode" => 200, "message" => "Designer profile has been approved successfully"]);
        } catch (\Exception $e) {
            return response()->json(['status' => 422, 'errors' => $e->getMessage()])->setStatusCode(422);
        }

    }

    public function rejectDesigner($id)
    {

        try {
            $customer = Designer::find($id);
            $customer->status = "disabled";
            $customer->save();

            return response()->json(["status" => "success", "statusCode" => 200, "message" => "Designer profile has been rejected successfully"]);
        } catch (\Exception $e) {
            return response()->json(['status' => 422, 'errors' => $e->getMessage()])->setStatusCode(422);
        }
    }
}

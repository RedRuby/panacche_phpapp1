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
use App\Vendor;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\AddVendorRequest;

class AdminController extends Controller
{
    public function index()
    {
    }

    public function newArrivalPendings()
    {
        $designers = Designer::where('status', 'pending')
            ->get();

        $designs = Collection::where('published', false)->where('status', 'submitted')->with('designer')->with('collectionImages')->get();

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
        $newDesignsCount = Collection::where('status', 'submitted')->count();
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
        $design = Collection::where('id', $id)->with('designer', 'collectionImages','bluePrintImages','colorPallettes','products', 'products.productImages')->get();

        $design = view('admin.viewDesign')->with('design', $design)->render();

        return response()->json(['status'=>200, 'success' => true, 'data'=>["design"=>$design], 'message'=>'Design details loaded successfully'])->setStatusCode(200);
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

    public function vendorDatalist()
    {
        $vendors = Vendor::all();

        $datalist = view('admin.vendorDatalist')->with('vendors', $vendors)->render();

        return response()->json(['status'=>200, 'success' => true, 'data'=>["datalist"=>$datalist], 'message'=>'Vendor datalist loaded successfully'])->setStatusCode(200);
        //return $datalist;
    }

    public function addVendor(AddVendorRequest $request)
    {
        $vendor_logo = $request->vendor_logo;
        $vendorLogoFileName ="";
        if (!empty($vendor_logo)) {
            //Display File Name
            $vendorLogoFileName = $vendor_logo->getClientOriginalName();

            //Move Uploaded File
            $destinationPath = public_path() . '/uploads/collection/vendor_logo/';
            $vendor_logo->move($destinationPath, $vendor_logo->getClientOriginalName());
        }


        $vendor  = Vendor::create([
            'vendor_name' => $request->vendor_name,
            'vendor_logo' => $vendorLogoFileName
        ]);

        $vendors = Vendor::all();
        $datalist = view('admin.vendorDatalist')->with('vendors', $vendors)->render();

        return response()->json(["status" => "success", "statusCode" => 200, 'data'=>["datalist"=>$datalist], "message" => "Vendor has been added successfully"]);
    }
}

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
use App\DesignRemark;
use App\DesignDisclaimer;

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

    public function reviewDesign($id)
    {
        $design = Collection::where('id', $id)->with('designer', 'collectionImages','bluePrintImages','colorPallettes','products', 'products.productImages', 'products.vendor')->get();

        $design = view('admin.reviewDesign')->with('design', $design)->render();

        return response()->json(['status'=>200, 'success' => true, 'data'=>["design"=>$design], 'message'=>'Design loaded successfully'])->setStatusCode(200);

    }

    public function updateDesignStatus($id, $status)
    {
        $design = Collection::find($id);
        $design->status = $status;
        $design->save();

        if($design){
            $message = 'design '.$status.' successfully';
            return response()->json(['status'=>200, 'success' => true, 'message'=>$message])->setStatusCode(200);
        }else{
            return response()->json(['status'=>400, 'success' => false, 'message'=>'Design not found'])->setStatusCode(400);
        }
    }

    public function addRemark(Request $request)
    {
        $collection = Collection::find($request->collection_id);
        $collection->remark = $request->remark;
        $collection->save();

        if($collection){
            return response()->json(['status'=>201, 'success' => true, 'message'=>"remark added successfully"])->setStatusCode(201);
        }else{
            return response()->json(['status'=>400, 'success' => false, 'message'=>'Design not found'])->setStatusCode(400);
        }
    }

    /*public function addDisclaimer(Request $request)
    {
        $collection = Collection::find($request->collection_id);

        if($collection){
            $disclaimer = DesignDisclaimer::create([
                'disclaimer' => $request->disclaimer,
                'collection_id' => $request->collection_id
            ]);

            return response()->json(['status'=>201, 'success' => true, 'message'=>"Disclaimer added successfully"])->setStatusCode(201);
        }else{
            return response()->json(['status'=>400, 'success' => false, 'message'=>'Design not found'])->setStatusCode(400);
        }
    }*/

    public function settings(Request $request)
    {
        $vendors = Vendor::count();
        $disclaimer = DesignDisclaimer::count();

        return response()->json(['status'=>200, 'success' => true, 'data'=>['vendors' => $vendors, "disclaimer"=>$disclaimer]])->setStatusCode(200);
    }

    public function vendors()
    {
        $vendors = Vendor::all();

        $vendors = view('admin.vendors')->with('vendors', $vendors)->render();
        return response()->json(['status'=>200, 'success' => true, 'data'=>['vendors' => $vendors, ]])->setStatusCode(200);
    }

    public function disclaimers()
    {
        $disclaimer = DesignDisclaimer::all();
        $disclaimers = view('admin.disclaimers')->with('disclaimers', $disclaimers)->render();
        return response()->json(['status'=>200, 'success' => true, 'data'=>['disclaimers' => $disclaimers, ]])->setStatusCode(200);
    }

    public function addDisclaimer(Request $request)
    {
        $disclaimer = DesignDisclaimer::create([
            'disclaimer'=>$request->disclaimer
        ]);

      //  $disclaimers = view('admin.disclaimers')->with('disclaimers', $disclaimers)->render();
        return response()->json(['status'=>200, 'success' => true, 'message'=>'disclaimer added successfully'])->setStatusCode(200);
    }

    public function editDisclaimer(Request $request, $id)
    {
        $disclaimer = DesignDisclaimer::find($id);
        $disclaimer->disclaimer = $request->disclaimer;
        $disclaimer->save();
        return response()->json(['status'=>200, 'success' => true, 'message'=>'disclaimer edited successfully'])->setStatusCode(200);
    }

    public function deleteDisclaimer($id)
    {
        $disclaimer = DesignDisclaimer::find($id);
        $disclaimer->delete();
        return response()->json(['status'=>200, 'success' => true, 'message'=>'disclaimer deleted successfully'])->setStatusCode(200);
    }


}

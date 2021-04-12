<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Designer;
use Illuminate\Support\Facades\Log;
use View;

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
}

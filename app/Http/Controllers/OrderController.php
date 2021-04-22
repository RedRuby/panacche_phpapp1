<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function orderCreation(Request $request)
    {
        Log::info('order creation: ' . json_encode($request->all()));

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;
use App\User;
use Osiset\BasicShopifyAPI\Options;
use Osiset\BasicShopifyAPI\BasicShopifyAPI;
use Osiset\BasicShopifyAPI\Session;

class ShopifyController extends Controller
{
    public function index(Request $request) {


            $shop = Auth::user();
            $domain = $shop->getDomain()->toNative();
            $shopApi = $shop->api()->rest('GET', '/admin/shop.json')['body']['shop'];

            Log::info("Shop {$domain}'s object:" . json_encode($shop));
            Log::info("Shop {$domain}'s API objct:" . json_encode($shopApi));
            return;

    }

    public function showToken(){
        echo csrf_token();

    }

    public function authAttempt(Request $request){
            $shop = User::where('name',$request->shop)->first();
            $options = new Options();
            $options->setVersion('2021-01');
            $api = new BasicShopifyAPI($options);
            $session = $api->setSession(new Session($shop->name, $shop->password));

            $result = $api->rest('GET', '/admin/smart_collections.json')['body'];
            return [$result,"hh", $session];

    }
}

?>

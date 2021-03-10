<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return view('welcome');
})->middleware(['auth.shopify'])->name('home');


Route::resource('customer', 'CustomerController');
Route::post('verify_email', 'CustomerController@verifyEmail');
Route::post('verify_username', 'CustomerController@verifyUsername');
Route::post('verify_phone', 'CustomerController@verifyPhone');
Route::post('verify_zip', 'CustomerController@verifyZip');

//Route::resource('design', 'DesignController');

Route::post('design', 'DesignController@store');
Route::get('design', 'DesignController@index');
Route::get('design/search', 'DesignController@searchDesign');
Route::get('our/designs', 'DesignController@ourDesigns');
Route::get('designer/profile/approve/{id}', 'CustomerController@approveDesigner');
Route::get('designer/profile/reject/{id}', 'CustomerController@rejectDesigner');

Route::get('/design/collection/exist/{title}', 'DesignController@collectionExist');
//Route::post('/design/add/products', 'DesignController@addProducts');


//Route::get('/admin/dashboard', 'AdminController@index');
Route::get('/admin/designers', 'AdminController@designers');
Route::get('/admin/designs', 'AdminController@designs');
Route::get('/admin/statistics', 'AdminController@statistics');


Route::get('shopify', 'ShopifyController@index')->middleware(['auth.shopify']);


Route::post('login', 'ShopifyController@authAttempt'); //->middleware(['auth.shopify']);


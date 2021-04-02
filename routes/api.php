<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
URL::forceScheme('https');

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
Route::post('/customer', 'CustomerController@store');

Route::post('verify_email', 'CustomerController@verifyEmail');
//Route::post('verify_username', 'CustomerController@verifyUsername');
Route::post('verify_phone', 'CustomerController@verifyPhone');
//Route::post('verify_zip', 'CustomerController@verifyZip');
Route::get('/get/customer/{id}', 'CustomerController@getCustomer');

Route::resource('design', 'DesignController');
//Route::get('/design/collection/exist/{title}', 'DesignController@collectionExist');
//Route::post('/design/add/products', 'DesignController@addProducts');
Route::post('verify_design_name', 'DesignController@verifyDesignName');
Route::post('/design/products', 'DesignController@uploadProducts');
Route::post('/design/products/bulk_upload', 'DesignController@bulkUpload');
Route::post('/design/submit', 'DesignController@submitDesign');
Route::get('/design/view_all/{type}', 'DesignController@viewAllByType');

//Route::post('/design', 'DesignController@store');
Route::get('design', 'DesignController@index');
Route::post('design/search', 'DesignController@searchDesign');
Route::get('our/designs', 'DesignController@ourDesigns');


//Route::get('/admin/dashboard', 'AdminController@index');
//Route::get('/admin/designers', 'AdminController@designers');
Route::get('/admin/designs', 'AdminController@designs');
Route::get('/admin/statistics', 'AdminController@statistics');
Route::get('/admin/design/{id}', 'AdminController@viewDesign');
Route::get('/new/new_arrival_pending', 'AdminController@newArrivalPendings');
Route::get('shopify', 'ShopifyController@index')->middleware(['auth.shopify']);
Route::get('/admin/designer/profile/{id}', 'AdminController@viewDesignerProfile');
Route::get('/admin/designer/profile/approve/{id}', 'AdminController@approveDesigner');
Route::get('/admin/designer/profile/reject/{id}', 'AdminController@rejectDesigner');

Route::post('login', 'ShopifyController@authAttempt'); //->middleware(['auth.shopify']);

//Route::get('/designer/users/{id}', 'DesignerController@users');
//Route::get('/designer/designs/{id}', 'DesignerController@designs');
//Route::get('/designer/statistics/{id}', 'DesignerController@statistics');
Route::post('/designer', 'DesignerController@store');
Route::get('/designer/dashboard/{id}', 'DesignerController@dashboard');
Route::get('/designer/designs/inprogress', 'DesignerController@inProgress');
Route::get('/designer/designs/draft', 'DesignerController@draft');
Route::get('/designer/designs/published', 'DesignerController@published');
Route::get('/designer/designs/under_review', 'DesignerController@under_review');
Route::get('/designer/designs/all', 'DesignerController@allDesigns');
Route::get('/designer/create-design/{id}', 'DesignerController@createDesign');

Route::get('view', 'FileController@view');
Route::get('get/resume/{filename}', 'FileController@getResumeFile')->name('get_resume_file');
Route::get('get/portfolio/{filename}', 'FileController@getPortfolioFile')->name('get_portfolio_file');




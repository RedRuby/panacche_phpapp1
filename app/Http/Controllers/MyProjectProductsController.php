<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MyProjectsCollectionProducts;
use Response;

class MyProjectProductsController extends Controller
{
    public function saveProduct(Request $request)
    {
        $qty_elm = $request->input('qty_elm');
        $checkbox_checked = $request->input('checkbox_checked');
        $myProjectId = $request->input('myProjectId');
        $product_id = $request->input('product_id');
        $my_product_id = $request->input('my_product_id');
        if($my_product_id){
            $post = MyProjectsCollectionProducts::where('id', '=', $my_product_id);
            if($checkbox_checked == '0'){
                $post->delete();
                $my_product_id = '';
            } else {
                $post->update(["my_project_id" => $myProjectId,"produt_id" => $product_id, "quantity" => $qty_elm]);
            }
            return Response::json(array('success' => true, 'id' => $my_product_id), 200);
        } else {
            if($checkbox_checked > 0){
                $data = new MyProjectsCollectionProducts;
                $data->my_project_id = $myProjectId;
                $data->produt_id = $product_id;
                $data->quantity = $qty_elm;
                if ($data->save()) {
                    return Response::json(array('success' => true, 'id' => $data->id), 200);
                }
            }
        }
    }
}

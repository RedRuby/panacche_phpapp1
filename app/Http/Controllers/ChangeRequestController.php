<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MyProjectChangeRequest;
use Response;

class ChangeRequestController extends Controller
{
    public function saveChangeRequest(Request $request)
    {
        $type = $request->input('change_type');
        $my_project_id = $request->input('myProjectId');
        $change_reason = $request->input('change_reason');
        $change_request_id = $request->input('change_request_id');
        $delete_change_request = $request->input('delete_change_request');
        $product_id = '';
        $color_id = '';
        $file_url = '';
        if($type == 0 && $delete_change_request != '1'){
            $product_id = $request->input('change_item');
            $file = $request->file('product_file');
            $inputs['folder']       = 'change_request';
            $inputs['filePrefix']   = "product_file_";
            $inputs['file'] = $file;
            $file_url = app('App\Http\Controllers\FileController')->store($inputs);
        } else {
            $color_id = $request->input('change_item');
        }
        $brand = $request->input('brand');
        $application = $request->input('application');

        if($change_request_id){
            $post = MyProjectChangeRequest::where('id', '=', $change_request_id);
            if($delete_change_request == '1'){
                $post->delete();
                $change_request_id = '';
            } else {
                $data_arry = ['type' => $type, 'my_project_id' => $my_project_id, 'change_reason' => $change_reason, 'file' => $file_url];
                if($product_id != '')
                    $data_arry['product_id'] = $product_id;
                if($color_id != '')
                    $data_arry['color_id'] = $color_id;
                $data_arry['brand'] = ($brand)?$brand:'';
                $data_arry['application'] = ($application)?$application:'';
                $post->update($data_arry);
            }
            return Response::json(array('success' => true, 'id' => $change_request_id), 200);
        } else {
            $data = new MyProjectChangeRequest;
            $data->type = $type;
            $data->my_project_id = $my_project_id;
            $data->change_reason = $change_reason;
            if($product_id != '')
                $data->product_id = $product_id;
            if($color_id != '')
                $data->color_id = $color_id;
            $data->brand = ($brand)?$brand:'';
            $data->application = ($application)?$application:'';
            $data->file = $file_url;
            if ($data->save()) {
                return Response::json(array('success' => true, 'id' => $data->id), 200);
            }
        }
    }
}

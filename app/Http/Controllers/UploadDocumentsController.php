<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MyProjectsUploadDocuments;
use Response;
use Log;

class UploadDocumentsController extends Controller
{
    public function uploadDocuments(Request $request)
    {
        $allData = $request->all();
        $upload_document_id = $request->id;
        if($upload_document_id){
            $post = MyProjectsUploadDocuments::find($upload_document_id);
            //app('App\Http\Controllers\FileController')->delete($post->file_url);
            $post->delete();
            return Response::json(array('success' => true, 'id' => ''), 200);
        } else {
            $file = $request->file('file_documents');
            $type = $request->type;
            Log::info("upload file :: ".print_r($file, true));
            if(isset($type) && $type != '') {
                if($type == config('constants.DESIGN_STEP2_FLOOR_PLAN')) {
                    $inputs['folder']       = config('constants.DESIGN_STEP2_FLOOR_PLAN_UPLOAD_S3_OBJECT');
                    $inputs['filePrefix']   = "floor_";
                } else if($type == config('constants.DESIGN_STEP2_FURNITURE_PLAN')) {
                    $inputs['folder']       = config('constants.DESIGN_STEP2_FURNITURE_PLAN_UPLOAD_S3_OBJECT');
                    $inputs['filePrefix']   = "furniture_";
                } else {
                    $inputs['folder']       = "";
                    $inputs['filePrefix']   = "";
                }
                $inputs['file'] = $file;
                $url = app('App\Http\Controllers\FileController')->store($inputs);
                $myProjectId = $request->myProjectId;
                $data = new MyProjectsUploadDocuments;
                $data->my_project_id = $myProjectId;
                $data->type = $type;
                $data->file_url = $url;
                if ($data->save()) {
                    return Response::json(array('success' => true, 'id' => $data->id, 'url' => $url), 200);
                }
            }
        }
        
    }

}

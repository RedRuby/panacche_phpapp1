<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MyProjectRefrenceLink;
use Response;

class RefrenceLinkController extends Controller
{
    public function saveRefrence(Request $request)
    {
        $refrenceLink = $request->input('refrenceLink');
        $referenceLinkId = $request->input('referenceLinkId');
        $myProjectId = $request->input('myProjectId');
        if($referenceLinkId){
            $post = MyProjectRefrenceLink::where('id', '=', $referenceLinkId);
            if($refrenceLink == ''){
                $post->delete();
                $referenceLinkId = '';
            } else {
                $post->update(["refrence_link" => $refrenceLink,"my_project_id" => $myProjectId]);
            }
            return Response::json(array('success' => true, 'id' => $referenceLinkId), 200);
        } else {
            $data = new MyProjectRefrenceLink;
            $data->refrence_link = $refrenceLink;
            $data->my_project_id = $myProjectId;
            if ($data->save()) {
                return Response::json(array('success' => true, 'id' => $data->id), 200);
            }
        }
    }
}

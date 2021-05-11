<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    function getResumeFile($filename){
        //$file=Storage::disk('public')->get($filename);
        if(strpos($filename, "http://") || strpos($filename, "http://") !== false){
            $path = $filename;
            $basename = basename($path, ".");

            return response()->download($path, $basename);
        }else{
            $path=public_path()."/uploads/designer/resume/".$filename;
            return response()->download($path, $filename);
        }

    }

    function getPortfolioFile($filename){

        if(strpos($filename, "http://" || strpos($filename, "http://")) !== false){
            $path = $filename;
            $basename = basename($path, ".");

            return response()->download($path, $basename);
        }else{
            $path=public_path()."/uploads/designer/portfolio/".$filename;
            return response()->download($path, $filename);
        }
    }

    public function store($inputs) {
        Log::info("FileController :: inputs :: ".print_r($inputs, true));

        $file       = $inputs['file'];
        $folder     = $inputs['folder'];
        $filePrefix = $inputs['filePrefix'];

        $name = $filePrefix.time().".".$file->getClientOriginalExtension();
        Log::info("upload file name :: ".print_r($name, true));

        $filePath = $folder."/".$name;
        Log::info("upload file filePath :: ".print_r($filePath, true));

        $put = Storage::disk('s3')->put($filePath, file_get_contents($file));
        Log::info("upload file put :: ".print_r($put, true));

        $url = config('constants.AWS_URL').$filePath;
        Log::info("upload file url :: ".print_r($url, true));

        if($put) {
            return $url;
        } else {
            return false;
        }
    }
}

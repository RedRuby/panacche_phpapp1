<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;

use Illuminate\Http\Request;

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
}

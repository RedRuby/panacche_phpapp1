<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\MyProjectsUploadDocuments;

class UploadDocumentsController extends Controller
{
    public function uploadDocuments(Request $request)
    {
        echo "aaa";die;
        $file = $request->file('file_documents');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CSVBulkUpload extends Model
{
    protected $fillable = [
        'collection_id',
        'file_name',
        'status'
    ];
}

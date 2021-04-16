<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesignDisclaimer extends Model
{
    protected $fillable = [
        'disclaimer',
        'collection_id'
    ];
}

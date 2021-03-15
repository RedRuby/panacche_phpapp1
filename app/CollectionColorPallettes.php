<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CollectionColorPallettes extends Model
{
    //

    protected $fillable = [
        'id',
        'collection_id',
        'color_img',
        'color_name',
        'brand',
        'finish',
        'application',
    ];
}

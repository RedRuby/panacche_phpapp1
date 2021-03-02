<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'collection_id', 'title', 'body', 'vendor', 'product_type', 'published', 'room_type', 'room_style', 'room_budget', 'status'
    ];
}



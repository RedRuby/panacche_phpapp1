<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
       'id', 'collection_id', 'title', 'published', 'status', 'description', 'size_specification', 'product_url', 'product_price', 'product_compare_at_price', 'product_quantity'
    ];
}



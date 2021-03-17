<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
       'id', 'collection_id', 'title', 'published', 'status', 'description', 'size_specification', 'product_url', 'product_price', 'product_compare_at_price', 'product_quantity'
    ];


    public function collection(){
        return $this->belongsTo('App\Collection');
    }

    public function productImages()
    {
        return $this->hasMany('App\ProductImages');
    }
}



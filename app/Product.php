<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
       'id', 'collection_id', 'title', 'published', 'status', 'description', 'size_specification', 'product_url', 'product_price', 'product_compare_at_price', 'product_quantity', 'vendor_id'
    ];


    public function collection(){
        return $this->belongsTo('App\Collection');
    }

    public function productImages()
    {
        return $this->hasMany('App\ProductImages');
    }

    public function vendor(){
        return $this->belongsTo('App\Vendor');
    }


}



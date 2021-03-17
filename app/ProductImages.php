<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    protected $fillable = ['product_id', 'img_src', 'img_alt'];

    public function product(){
        return $this->belongsTo('App\Product');
    }
}

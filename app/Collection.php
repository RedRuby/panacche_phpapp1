<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Collection extends Model
{
    protected $fillable = ['id', 'customer_id', 'design_name', 'description', 'image_src', 'image_alt', 'published', 'room_type', 'room_style', 'room_budget', 'status', 'design_implementation_guide', 'room_widht', 'room_height'];

    public function collectionImages()
    {
        return $this->hasMany('App\CollectionImages');
    }

    public function customer(){
        return $this->belongsTo('App\Customer');
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public function bluePrintImages()
    {
        return $this->hasMany('App\CollectionBluePrints');
    }

    public function colorPallettes()
    {
        return $this->hasMany('App\CollectionColorPallettes');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Collection extends Model
{
    protected $fillable = ['id', 'designer_id', 'design_name', 'implementation_guide_description', 'image_src', 'image_alt', 'published', 'room_type', 'room_style', 'room_budget', 'status', 'design_implementation_guide', 'room_width_in_feet', 'room_width_in_inches', 'room_height_in_feet', 'room_height_in_inches', 'pet_friendly_design', 'design_price'];

    public function collectionImages()
    {
        return $this->hasMany('App\CollectionImages');
    }

    public function designer(){
        return $this->belongsTo('App\Designer');
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

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function digitalProduct()
    {
        return $this->hasOne('App\DigitalProduct');
    }

    public function getRandomDesigns() {
        return Collection::all()->random(4);
    }
}

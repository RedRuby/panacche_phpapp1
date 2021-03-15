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
}

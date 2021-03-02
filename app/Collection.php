<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $fillable = [ 'customer_id', 'title', 'description', 'image_src', 'image_alt', 'published', 'room_type', 'room_style', 'room_budget', 'status'];
}

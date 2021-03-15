<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CollectionImages extends Model
{
    protected $fillable = ['collection_id', 'img_src', 'img_alt'];

    public function collection(){
        return $this->belongsTo('App\Collection');
    }
}

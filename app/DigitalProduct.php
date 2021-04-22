<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DigitalProduct extends Model
{
    protected $fillable = [
        'id',
        'collection_id',
        'name',
        'product_price',
        'product_type',
        'file_path'
    ];

    public function collection(){
        return $this->belongsTo('App\Collection');
    }
}

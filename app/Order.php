<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [

    ];

    public function collection(){
        return $this->belongsTo('App\Collection');
    }

    public function customer(){
        return $this->belongsTo('App\Customer');
    }



}


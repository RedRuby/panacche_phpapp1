<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'vendor_name',
        'vendor_logo'
    ];

    public function product()
    {
        return $this->hasOne('App\Product');
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disclaimer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'disclaimer',
        'created_by',
        'status'
    ];

    public function designDisclaimer()
    {
        return $this->hasMany('App\DesignDesclaimer');
    }

    public function customer()
    {
        return $this->hasOne('App\Customer', 'id', 'created_by');
    }
}

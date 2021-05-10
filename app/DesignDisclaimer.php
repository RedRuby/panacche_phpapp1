<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DesignDisclaimer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'disclaimer_id',
        'collection_id'
    ];

    public function disclaimer()
    {
        return $this->belongsTo('App\Desclaimer');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designer extends Model
{
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'email',
        'password',
        'display_picture',
        'phone',
        'bio',
        'quote',
        'business_name',
        'business_address',
        'website_url',
        'resume',
        'portfolio'
    ];
}

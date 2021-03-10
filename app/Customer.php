<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
//use Illuminate\Notifications\Notifiable;

class Customer extends Model
{

    //use SoftDeletes;
    //use Notifiable;

    protected $fillable = [
        'id', 'username', 'email', 'first_name', 'last_name', 'username', 'password', 'status', 'phone', 'address','locality', 'city', 'zip', 'state', 'country', 'profile_type', 'profile_picture', 'designer_certificate', 'communication_channels', 'tag'
    ];
}

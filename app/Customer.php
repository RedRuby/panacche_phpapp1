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
        'id', 'email', 'first_name', 'last_name', 'password', 'status', 'phone', 'display_picture', 'how_did_you_hear_about_us', 'tag'];



    public function collections()
    {
        return $this->hasMany('App\Collection');
    }

    public function designer()
    {
        return $this->belongsToMany('App\Designer');
    }

}

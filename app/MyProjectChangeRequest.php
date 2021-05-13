<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyProjectChangeRequest extends Model
{
	protected $table = 'my_project_change_request';
	protected $fillable = ['product_id', 'color_id','brand','application','file'];
}

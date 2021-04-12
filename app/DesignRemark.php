<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesignRemark extends Model
{
    protected $fillable = ['collection_id', 'remark'];
}

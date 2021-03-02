<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CollectionRule extends Model
{
    protected $fillable = ['collection_id', 'title', 'rule_key', 'rule_value'];
}

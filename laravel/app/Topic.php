<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //
    public $fillable = ['parent_id', 'content', 'name', 'create_time'];
    public $timestamps = false;
}

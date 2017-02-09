<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    //
    public $fillable=['mine_id','other_id','name','content','create_time','head_ico'];
    public $timestamps = false;
}

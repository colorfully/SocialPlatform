<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    //
    public $fillable=['name','head_ico','room','content','create_time','status'];
    public $timestamps = false;
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //
    public $fillable=['activity_name','title','num','Participants','create_time'];
    public $timestamps = false;
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //
    protected $fillable = ['name','title','content','cover','num','Participants', 'create_time'];
    public $timestamps = false;
}

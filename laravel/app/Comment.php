<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    //
    protected $fillable = ['parent_id', 'gra_parent_id', 'name', 'content','create_time','article_id'];
    //protected $date=['create_time'];
    //
    public $timestamps = false;
   
}
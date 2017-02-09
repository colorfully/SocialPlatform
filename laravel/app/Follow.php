<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    //
    protected $fillable = ['name', 'fan','follow'];
    public $timestamps = false;
}

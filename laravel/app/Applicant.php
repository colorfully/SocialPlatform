<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    //
    protected $fillable = ['applicant_id','applicant_name','activity_id','apply_reason','contact','status', 'create_time'];
    public $timestamps = false;
}

<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    //
    public $fillable = ['title','like_id', 'content', 'published_at', 'user_id','author','intro','first_pic','second_pic','third_pic'];
    protected $date=['published_at'];
    //

    public function setPublishedAttribute($date)
    {
        $this->attributes['published_at']=Carbon::createFromFormat('Y-m-d',$date);
    }


    public function scopePublished($query)
    {
        $query->where('published_at','<=',Carbon::now());
    }

    public function scopeLiked($query)
    {
        $query->orderBy('like','desc');
    }
   
}

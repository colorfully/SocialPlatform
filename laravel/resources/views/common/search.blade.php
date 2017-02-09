@extends('layouts.app')
@section('content')
    @if($search_name!=null)
        <div class="person" style="margin-bottom: 50px;">
            <h4>相关用户</h4>
            @foreach($search_name as $users)
                <div class="user_msg" style="padding: 20px;float: left">
                    <img src="{{$users->head_ico}}" class="head_ico_index" style="margin-left: 10px">
                    <h3><a href="{{asset('author/').'/'.$users->name}}"
                           style="text-decoration: none">{{$users->name}}</a></h3>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-warning" role="alert" style="margin-top: 50px;clear: both;">找不到相关的用户</div>
    @endif
    @if($search!=null)
        <div class="search" style="margin-top: 50px;clear: both;">
            <h4>相关文章</h4>
            @foreach($search as $art)
                <div class="article-list">
                    <div class="article-title">
                        <div class="container-fluid">
                            <div class="row">
                                <div style="float: left">
                                    @if($art->first_pic!=null)
                                        <img src="{{$art->first_pic}}" style="width: 200px;margin-right: 5px">
                                    @endif
                                </div>
                                <div>
                                    <span>
                                        <b style="font-size: 24px">
                                            <a style="margin-top:30px"
                                               href="/articles/{{$art->id}}">{{$art->title}}
                                            </a>
                                        </b>
                                    </span>
                                    <div style="padding: 5px">
                                        <h4><a href="/articles/{{$art->id}}"
                                               style="text-decoration: none">{{$art->intro}}....
                                            </a></h4>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="article-content">
                        <div class="article-detail" style="text-align: right;margin-top: 5px">
                            <i class="fa fa-pencil-square-o"></i><a href="{{asset('author/').'/'.$art->author}}"><img
                                        class="head_ico_index" src="{{$art->head_ico}}"></a>
                                <span>
                                    <strong>{{$art->author}}</strong>
                               </span>
                                   <span><i class="fa fa-clock-o"
                                            style="margin-right: 3px"></i>{{date("Y-m-d",strtotime($art->published_at))}}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-warning" role="alert" style="margin-top: 50px;clear: both;">找不到相关的文章标题和内容</div>
    @endif
    @if($search_topic!=null)
        <div class="search_topic" style="margin-top: 50px;clear: both;">
            <h4>相关话题</h4>
            @foreach($search_topic as $topic)
                <div class="article-list">
                    <div class="article-title col-md-2">
                        <div>
                            <div class="col-md-3">
                                <img class="head_ico_index" src="{{$topic->head_ico}}">
                            </div>
                        </div>
                        <div style="text-align: center;clear:both ">
                            <a href="{{asset('/author/'.$topic->name)}}">{{$topic->name}}</a>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div>
                            <div class="demo clearfix">
                                <span class="triangle"></span>
                                <div class="article">
                                    <div style="padding: 15px"><h4><a href="{{asset('topic/'.$topic->id)}}"
                                                                      style="text-decoration: none">{{$topic->content}}</a>
                                        </h4>
                                    </div>
                                    <div>
                                        <div style="float: right;clear: both">
                                            {{date("Y-m-d H:i:s",strtotime($topic->create_time))}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    @if($search_activity!=null)
        <div class="search_activity" style="margin-top: 50px;clear: both;">
            <h4>相关活动</h4>
            @foreach($search_activity as $activity)
                <div class="activity-list" style="margin-top: 10px">
                    <div class="article-title">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="{{asset('author/'.$activity->name)}}"><img class="head_ico_index"
                                                                                        src="{{$activity->head_ico}}"></a>
                                    <div class="text-left">
                                        {{$activity->name}}
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <span class="right"><i class="icon-calendar"
                                                           style="margin-right: 3px"></i> {{date("Y-m-d H:i:s",strtotime($activity->create_time))}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="article-content">
                        <div class="org_box">
                            <span class="org_bot_cor"></span>
                            <div class="row">
                                @if($activity->cover!=null)
                                <div class="col-md-2" style="padding: 5px">
                                    <img src="{{$activity->cover}}"
                                         style="border-radius: 10px;width: 100px;height: 100px">
                                </div>
                                @endif
                                <div class="col-md-6" style="padding: 10px">
                                    <h4><a href="{{asset('activity/'.$activity->id)}}"
                                           style="text-decoration: none">{{$activity->title}}
                                        </a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    @if($nosearch==true)
        <div class="alert alert-warning" role="alert" style="margin-top: 50px;clear: both;">找不到任何内容</div>
    @endif
@endsection

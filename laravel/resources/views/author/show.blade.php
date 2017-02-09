@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="box box-primary">
            <div class="col-md-10 col-md-offset-1">
                <!-- Profile Image -->
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{$user->head_ico}}"
                         alt="User profile picture">

                    <h3 class="profile-username text-center">{{$user->name}}</h3>

                    <p class="text-muted text-center">{{$user->intro}}</p>
                    <p class="text-muted text-center">{{$user->email}}</p>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>文章数量</b> <a class="pull-right"
                                           href="{{asset('author/').'/'.$user->name}}">{{$article_num}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>话题</b> <a class="pull-right"
                                         href="{{asset('/author').'/'.$user->name.'/show/topic'}}">{{$topic_num}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>活动</b> <a class="pull-right"
                                         href="{{asset('/author').'/'.$user->name.'/show/activity'}}">{{$activity_num}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>粉丝</b> <a class="pull-right"
                                         href="{{asset('/author').'/'.$user->name.'/fanlist'}}">{{$fans_num}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>跟踪</b> <a class="pull-right"
                                         href="{{asset('/author').'/'.$user->name.'/follow'}}">{{$follow_num}}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-top: 20px;padding: 10px">
        <div class="box box-primary">
            @if($category=='topic')
                @if($result->total()!=0)
                @foreach($result as $topic)
                    <div class="article-list">
                        <div class="article-title col-md-2">
                            <div class="col-md-3">
                                <img class="head_ico_index" src="{{$topic->head_ico}}">
                            </div>
                            <div style="text-align: center;clear:both ">
                                <a href="{{asset('author/').$topic->name}}">{{$topic->name}}</a>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div>
                                <div class="demo clearfix">
                                    <span class="triangle"></span>
                                    <div class="article">
                                        <div style="padding: 15px"><h4><a href="{{asset('topic').'/'.$topic->id}}"
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
                <div class="right">{!! $result->render() !!}</div>
                    @else
                    <div class="alert alert-warning" role="alert" style="margin-top: 20px;padding: 10px">该用户没有提问过问题</div>
                    @endif
            @endif
            @if($category=='activity')
                    @if($result->total()!=0)
                @foreach($result as $activity)
                    <div class="activity-list" style="margin-top: 10px">
                        <div class="article-title">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-3">
                                        <a href="{{asset('author').'/'.$activity->name}}"><img class="head_ico_index"
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
                                        <h4><a href="{{asset('activity').'/'.$activity->id}}"
                                               style="text-decoration: none">{{$activity->title}}
                                            </a></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="right">{!! $result->render() !!}</div>
                        @else
                        <div class="alert alert-warning" role="alert" style="margin-top: 20px;padding: 10px">该用户没有建立过活动</div>
                        @endif
            @endif

        </div>
    </div>

    <script type="application/javascript">
        $(function () {
            $('#follow').on('click', function () {
                var fdata = new Object();
                fdata.followed_name = '{{$user->name}}';
                fdata.follow_name = '{{Auth::user()->name}}';
                fdata.followed_id = '{{$user->id}}';
                fdata.follow_id = '{{Auth::user()->id}}';
                $.ajax({
                    type: "post",
                    url: "/follow",
                    data: {
                        _token: '{{csrf_token()}}',//防CSRF攻击
                        follow: fdata
                    },
                    dataType: "json",
                    success: function (data) {
                        location.reload();
                    }
                })
            })
            $('#unfollow').on('click', function () {
                var fdata = new Object();
                fdata.followed_name = '{{$user->name}}';
                fdata.follow_name = '{{Auth::user()->name}}';
                fdata.followed_id = '{{$user->id}}';
                fdata.follow_id = '{{Auth::user()->id}}';
                $.ajax({
                    type: "post",
                    url: "/unfollow",
                    data: {
                        _token: '{{csrf_token()}}',//防CSRF攻击
                        unfollow: fdata
                    },
                    dataType: "json",
                    success: function (data) {
                        location.reload();
                    }
                })
            })
        })
    </script>
@endsection
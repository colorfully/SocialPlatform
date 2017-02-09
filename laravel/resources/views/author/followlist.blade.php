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
        <div class="box box-primary" style="margin-top: 20px;padding: 10px">
        @if($follows_info==null)
            <div class="alert alert-warning" role="alert">你目前还没有跟踪人</div>
        @else
            @foreach($follows_info as $fol)
                <a href="{{asset('author/').'/'.$fol->name}}" style="margin-right: 10px"><img class="head_ico"
                                                                                              src="{{$fol->head_ico}}"></a><span>{{$fol->name}}</span>
            @endforeach
        @endif
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
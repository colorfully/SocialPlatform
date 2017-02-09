@extends('layouts.app')
@section('content')
    {{--<link rel="stylesheet" href="{{ URL::asset('/css/AdminLTE.css') }}">--}}
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
                    @if($user->name!=Auth::user()->name)
                        @if($check==true)
                            <button class="btn btn-warning btn-block" id="unfollow"><i class="fa fa-plus"
                                                                                       style="margin-right: 5px"></i>取消关注
                            </button>
                            <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal"><i
                                        class="fa fa-envelope-o" style="margin-right: 5px"></i>私信
                            </button>
                        @else
                            <button class="btn btn-primary btn-block" id="follow"><i class="fa fa-plus"
                                                                                     style="margin-right: 5px"></i>关注
                            </button>
                            <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal"><i
                                        class="fa fa-envelope-o" style="margin-right: 5px"></i>私信
                            </button>
                        @endif
                    @endif
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <div class="box box-info">
        <div class="personal-article">
            @foreach($article as $art)
                <div class="article-list">
                    <div class="article-title" style="float: left"><a href="/articles/{{$art->id}}">
                            <h3>{{$art->title}}</h3></a>
                        <span style="float: left">{{date("Y-m-d ",strtotime($art->published_at))}}</span>
                    </div>
                    <div style="border-radius: 10px;">

                        <div class="article-content"><p>&nbsp;&nbsp;&nbsp;{{$art->intro}}</p></div>
                    </div>
                </div>
            @endforeach
            <div class="right">{!! $article->render() !!}</div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">私信</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="chat_content">内容</label>
                        <textarea id="chat_content" class="form-control" rows="4" placeholder="写下你想对他说的话..."
                                  required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="letter">提交</button>
                </div>
            </div>
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
            $('#myModal').modal('hide');
            $('#letter').on('click', function () {
                $.ajax({
                    type: "post",
                    url: "/letter",
                    data: {
                        _token: '{{csrf_token()}}',//防CSRF攻击
                        other_id: ' {{$user->id}}',
                        content: $('#chat_content').val()
                    },
                    dataType: "json",
                    success: function (data) {
                        alert(data);
                        $('#myModal').modal('hide');
                    },
                    error: function (data) {
                        console.log(data);
                        alert(data.responseText);

                        var obj = eval(data.responseText);
                        console.log(obj);
//                            alert(obj);
                    }
                })
            })

        })
    </script>
@endsection
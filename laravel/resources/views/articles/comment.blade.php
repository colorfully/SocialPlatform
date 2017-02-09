@extends('layouts.app')
@section('content')
    @if($NewComments=="")
    @else
        <h4>最新回复</h4>
        @foreach($NewComments as $com)
            <div class="article-list">
                <div class="article-title">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8">
                                <a href="http://localhost:8000/author/{{$com->name}}"><img class="head_ico_index"
                                                                                           src="{{$com->head_ico}}"></a>
                                <div class="text-left">
                                    {{$com->name}}
                                </div>
                                <p>
                                    <a style="float: left"
                                       href="{{asset('articles/'.$com->article_id)}}">来自<b>{{$com->title}}</b>
                                    </a>
                                </p>
                            </div>
                            <div class="col-md-4" style="text-align: right;margin-top: 10px">
                                <span><i class="fa fa-clock-o"
                                         style="margin-right: 3px"></i>{{date("Y-m-d H:i:s",strtotime($com->create_time))}}</span>
                                <button class="btn btn-warning reply" style="margin-top: 10px" data-toggle="modal"
                                        data-target="#replyModel" parent_id="{{$com->parent_id}}"
                                        comment_id="{{$com->id}}" gra_parent_id="{{$com->gra_parent_id}}"
                                        article_id="{{$com->article_id}}">回复
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="article-content">
                    <div class="org_box">
                        <span class="org_bot_cor"></span>
                        <div style="padding: 15px">
                            <h4>{{$com->content}}</h4>
                        </div>

                    </div>

                </div>
            </div>
        @endforeach
        @foreach($comme as $comm)
            <div class="article-list">
                <div class="article-title">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8">
                                <a href="http://localhost:8000/author/{{$comm->name}}"><img class="head_ico_index"
                                                                                           src="{{$comm->head_ico}}"></a>
                                <div class="text-left">
                                    {{$comm->name}}
                                </div>
                                <p>
                                    <a style="float: left"
                                       href="{{asset('articles/'.$comm->article_id)}}">来自<b>{{$comm->title}}</b>
                                    </a>
                                </p>
                            </div>
                            <div class="col-md-4" style="text-align: right;margin-top: 10px">
                                <span><i class="fa fa-clock-o"
                                         style="margin-right: 3px"></i>{{date("Y-m-d H:i:s",strtotime($comm->create_time))}}</span>
                                <button class="btn btn-warning reply" style="margin-top: 10px" data-toggle="modal"
                                        data-target="#replyModel" parent_id="{{$comm->parent_id}}"
                                        comment_id="{{$comm->id}}" gra_parent_id="{{$comm->gra_parent_id}}"
                                        article_id="{{$comm->article_id}}">回复
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="article-content">
                    <div class="org_box">
                        <span class="org_bot_cor"></span>
                        <div style="padding: 15px">
                            <h4>{{$comm->content}}</h4>
                        </div>

                    </div>

                </div>
            </div>
            @endforeach
        <hr>
    @endif
    <h4>关于你的评论</h4>
    @foreach($comments as $coms)
        <div class="article-list">
            <div class="article-title">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <a href="http://localhost:8000/author/{{$coms->name}}"><img class="head_ico_index"
                                                                                        src="{{$coms->head_ico}}"></a>
                            <div class="text-left">
                                {{$coms->name}}
                            </div>
                            <p>
                                <a style="float: left"
                                   href="{{asset('articles/'.$coms->article_id)}}">来自<b>{{$coms->title}}</b>
                                </a>
                            </p>
                        </div>
                        <div class="col-md-4" style="text-align: right;margin-top: 10px">
                            <span><i class="fa fa-clock-o"
                                     style="margin-right: 3px"></i>{{date("Y-m-d H:i:s",strtotime($coms->create_time))}}</span>
                            <button class="btn btn-warning reply" style="margin-top: 10px" data-toggle="modal"
                                    data-target="#replyModel" parent_id="{{$coms->parent_id}}"
                                    comment_id="{{$coms->id}}" gra_parent_id="{{$coms->gra_parent_id}}"
                                    article_id="{{$coms->article_id}}">回复
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="article-content">
                <div class="org_box">
                    <span class="org_bot_cor"></span>
                    <div style="padding: 15px">
                        <h4>{{$coms->content}}</h4>
                    </div>

                </div>

            </div>
        </div>
    @endforeach
    @foreach($comment as $co)
        <div class="article-list">
            <div class="article-title">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <a href="http://localhost:8000/author/{{$co->name}}"><img class="head_ico_index"
                                                                                        src="{{$co->head_ico}}"></a>
                            <div class="text-left">
                                {{$co->name}}
                            </div>
                            <p>
                                <a style="float: left"
                                   href="{{asset('articles/'.$co->article_id)}}">来自<b>{{$co->title}}</b>
                                </a>
                            </p>
                        </div>
                        <div class="col-md-4" style="text-align: right;margin-top: 10px">
                            <span><i class="fa fa-clock-o"
                                     style="margin-right: 3px"></i>{{date("Y-m-d H:i:s",strtotime($co->create_time))}}</span>
                            <button class="btn btn-warning reply" style="margin-top: 10px" data-toggle="modal"
                                    data-target="#replyModel" parent_id="{{$co->parent_id}}"
                                    comment_id="{{$co->id}}" gra_parent_id="{{$co->gra_parent_id}}"
                                    article_id="{{$co->article_id}}">回复
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="article-content">
                <div class="org_box">
                    <span class="org_bot_cor"></span>
                    <div style="padding: 15px">
                        <h4>{{$co->content}}</h4>
                    </div>

                </div>

            </div>
        </div>
    @endforeach
    {{--回复模态框--}}
    <div class="modal fade" id="replyModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">回复</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" id="parent_id" class="form-control hidden" >
                    </div>
                    <div class="form-group">
                        <input type="text" id="gra_parent_id" class="form-control  hidden">
                    </div>
                    <div class="form-group">
                        <input type="text" id="article_id" class="form-control  hidden">
                    </div>
                    <div class="form-group">
                        <input type="text" id="comment_id" class="form-control  hidden">
                    </div>
                    <div class="form-group">
                        <textarea id="reply_content" class="form-control" rows="4" placeholder="回复内容..."
                                  required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="reply">提交</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('.reply').on('click', function () {
                var parent_id = $(this).attr("parent_id");
                var gra_parent_id = $(this).attr("gra_parent_id");
                var article_id = $(this).attr("article_id");
                var comment_id = $(this).attr("comment_id");
                //向模态框中传值
                $('#parent_id').val(parent_id);
                $('#gra_parent_id').val(gra_parent_id);
                $('#article_id').val(article_id);
                $('#comment_id').val(comment_id);
                $('#replyModel').modal('hide');
            });

            $('#reply').on('click', function () {
                if ("" == $('#reply_content').val()) {
                    alert("评论内容不能为空!");
                } else {
                    var cmdata = new Object();
                    cmdata.parent_id = $('#comment_id').val();//上级评论id
                    cmdata.content = $('#reply_content').val();
                    cmdata.name = '{{Auth::user()->name}}';//测试用数据
                    cmdata.article_id = $('#article_id').val();
                    cmdata.gra_parent_id = $('#parent_id').val();
                }
                $.ajax({
                    type: "POST",
                    url: "/addComment",
                    data: {
                        _token: '{{csrf_token()}}',//防CSRF攻击
                        comment: cmdata
                    },
                    dataType: "json",
                    success: function (data) {
                        alert('回复成功');
                        $('#replyModel').modal('hide');
                    }
                });
            })
        })
    </script>
@endsection
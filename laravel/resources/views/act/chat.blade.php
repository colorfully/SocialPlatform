@extends('layouts.app')
@section('content')
    <div class="box box-info">
        <div class="box box-header">
            聊天室:{{$room->title}}
        </div>
        <div class="box box-info">
            人员:@foreach($partner as $user)
                <img src="{{$user->head_ico}}" class="head_ico_index">
            @endforeach
        </div>
        <div class="box box-body">
            @foreach($chat as $chats)
                <div class="article-list">
                    <div class="article-title col-md-2">
                        <div >
                            <div class="col-md-3">
                                <img class="head_ico_index" src="{{$chats->head_ico}}">
                            </div>
                        </div>
                        <div style="text-align: center;clear:both ">
                            <a href="{{asset('author/').'/'.$chats->name}}">{{$chats->name}}</a>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div>
                            <div class="demo clearfix">
                                <span class="triangle"></span>
                                <div class="article">
                                    <div style="padding: 15px"><h4>{{$chats->content}}</h4>
                                    </div>
                                    <div >
                                        <div style="float: right;clear: both">
                                            {{date("Y-m-d  H:i:s",strtotime($chats->create_time))}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="form-group">
            <textarea class="form-control" rows="3" placeholder="发送消息" id="content"></textarea>
            <button class="btn btn-primary right" id="send">发送</button>
        </div>
    </div>
    <script>
        $(function () {
            $('#send').on('click',function () {
                $.ajax({
                    type: "post",
                    url: "/create/chat",
                    data: {
                        _token: '{{csrf_token()}}',//防CSRF攻击
                        content: $('#content').val(),
                        room:'{{$room->title}}'
                    },
                    dataType: "json",
                    success: function (data) {
                        alert(data);
                        location.reload();
                    },
                    error: function (data) {
                    }
                })
            })
        })
    </script>
@endsection
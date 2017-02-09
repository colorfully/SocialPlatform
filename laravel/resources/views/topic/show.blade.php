@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-body">
                    <div class="form-group">
                        <textarea name="content" id="content" rows="4"  class="form-control" placeholder="您对话题的想法"></textarea>
                    </div>
                    <div class="form-group" style="float: right">
                        <button type="submit" class="btn btn-primary" id="sure">确定</button>
                    </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <img class="head_ico_index" src="{{$result->head_ico}}">
               <span>{{$result->name}}</span>
            </div>
            <div class="panel-body">
                <div class="article">
                    <div style="padding: 15px;float: left"><h4>{{$result->content}}</h4>
                    </div>
                    <div style="float: right;clear: both">
                        {{date("Y-m-d  h:i:s",strtotime($result->create_time))}}
                    </div>
                </div>
            </div>
        </div>
        <div id="add">

        </div>
        @foreach($answer as $reply)
            <div class="row">
                <div class="col-md-9">
                    <div class="demo clearfix">
                        <span class="triangle_right"></span>
                        <div class="article">
                            <div style="padding: 15px;float: left"><h4>{{$reply->content}}</h4>
                            </div>
                            <div style="float: right;clear: both">
                                {{date("Y-m-d  h:i:s",strtotime($reply->create_time))}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <img class="head_ico_index" src="{{$reply->head_ico}}">
                    <div style="clear: both">{{$reply->name}}</div>
                </div>
            </div>
            @endforeach
        {!! $answer->render() !!}
    </div>
    <script>
        $(function () {
            $('#sure').on('click',function () {
                    $.ajax({
                        type:"post",
                        url:"/topic/answer",
                        data:{
                            _token:'{{csrf_token()}}',//防CSRF攻击
                            content: $('#content').val(),
                            id:'{{$result->id}}'
                        },
                        dataType:"json",
                        success:function(data){
                            if(data.error==null) {
                                var $item = $(' <div class="row"> <div class="col-md-9"> <div class="demo clearfix"> <span class="triangle_right"></span> <div class="article"> <div style="padding: 15px;float: left"><h4>' + data.content + '</h4> </div> <div style="float: right;clear: both">' + data.time + '</div> </div> </div> </div> <div class="col-md-2"> <img class="head_ico_index" src="' + data.head_ico + '"> <div style="clear: both">' + data.name + '</div> </div> </div>');
                                $('#add').append($item);
                            }else{
                                alert(data.error);
                            }
                        }
                    })
            })
        })
    </script>
    @endsection
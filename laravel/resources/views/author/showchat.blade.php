@extends('layouts.app')
@section('content')
    @foreach($private as $privater)
        {{--输出privater--}}
        <div class="article-list">
            <div class="article-title col-md-2">
                <div>
                    <div class="col-md-3">
                        <img class="head_ico_index" src="{{$privater->head_ico}}">
                    </div>
                </div>
                <div style="text-align: center;clear:both ">
                    <a href="{{asset('author/').'/'.$privater->name}}">{{$privater->name}}</a>
                </div>
            </div>
            <div class="col-md-9">
                <div>
                    <div class="demo clearfix">
                        <span class="triangle"></span>
                        <div class="article">
                            <div style="padding: 15px"><h4>{{$privater->content}}</h4>
                            </div>
                            <div>
                                <div style="float: right;clear: both">
                                    {{date("Y-m-d  H:i:s",strtotime($privater->create_time))}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <button class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="float: right"><i
                class="fa fa-envelope-o" style="margin-right: 5px;"></i>回复
    </button>
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
                    <button type="button" class="btn btn-primary" id="reply">提交</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#myModal').modal('hide');
        $('#reply').on('click', function () {
            $.ajax({
                type: "post",
                url: "/replyLetter",
                data: {
                    _token: '{{csrf_token()}}',//防CSRF攻击
                    other_id: '{{$mine_id}}',
                    content: $('#chat_content').val()
                },
                dataType: "json",
                success: function (data) {
                    alert(data);
                    $('#myModal').modal('hide');
                    if(data=='发送成功'){
                        location.reload();
                    }
                },
                error: function (data) {
                }
            })
        })
    </script>
@endsection
@extends('layouts.app')
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-9">
                    {{$activity->title}}
                </div>
                <div class="col-md-3">
                    {{$activity->name}}
                </div>
            </div>
        </div>
        <div class="panel-body">
            {!!  $show !!}
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-md-6" style="line-height: 30px">
                    人数:{{$activity->num}}
                </div>
                @if(!$check)
                <div class="col-md-6">
                    <button class="btn btn-default right" data-toggle="modal" data-target="#myModal"><i class="fa fa-envelope-o" style="margin-right: 5px
                       ;"></i>申请
                    </button>
                </div>
                    @endif
                @if($activity->name==Auth::user()->name)
                    @if($checkRoom==null&&$activity->num>=3)
                    <div class="col-md-6">
                        <button class="btn btn-default right" data-toggle="modal" data-target="#buildRoom"><i class="fa fa-home" style="margin-right: 5px
                       ;"></i>建立聊天室
                        </button>
                    </div>
                        @elseif($checkRoom!=null)
                        <div class="col-md-6">
                            <button class="btn btn-default right" disabled="disabled"><i class="fa fa-home" style="margin-right: 5px
                       ;"></i>已存在聊天室
                            </button>
                        </div>
                        @endif
                    @endif
            </div>
            <div class="row" style="padding: 10px;">
                参与者:
                @foreach($applicants as $a)
                    <img src="{{$a->head_ico}}" class="head_ico_index">
                    @endforeach
            </div>
        </div>
    </div>

    {{--申请模态框--}}
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">申请</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="apply_reason">申请理由</label>
                        <textarea id="apply_reason" class="form-control" rows="4" placeholder="写下你申请加入的理由..." required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="contact">联系方式</label>
                        <input type="text" id="contact" class="form-control"  placeholder="留下你的联系方式手机或者微信" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="apply">提交</button>
                </div>
            </div>
        </div>
    </div>


    {{--建立聊天室模态框--}}
    <div class="modal fade" id="buildRoom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">建立聊天室</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input id="room_title" class="form-control" placeholder="写下聊天室名称" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="build">提交</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#myModal').modal('hide');
        $('#buildRoom').modal('hide');
        $('#build').on('click', function () {
            $.ajax({
                type: "post",
                url: "/create/room",
                data: {
                    _token: '{{csrf_token()}}',//防CSRF攻击
                    content: $('#room_title').val(),
                    Participants:'{{$activity->Participants}}',
                    num:'{{$activity->num}}',
                    activity_name:'{{$activity->title}}'
                },
                dataType: "json",
                success: function (data) {
                    alert(data);
                    $('#buildRoom').modal('hide');
                    location.reload();
                },
                error: function (data) {
                }
            })
        });
        $('#apply').on('click', function () {
            $.ajax({
                type: "post",
                url: "/apply",
                data: {
                    _token: '{{csrf_token()}}',//防CSRF攻击
                    content: $('#apply_reason').val(),
                    activity_id:'{{$activity->id}}',
                    contact:$('#contact').val()
                },
                dataType: "json",
                success: function (data) {
                    alert(data);
                    $('#myModal').modal('hide');
                },
                error: function (data) {
                }
            })
        });
    </script>
@endsection
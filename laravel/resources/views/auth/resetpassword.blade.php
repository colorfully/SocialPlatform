@extends('layouts.common')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">找回密码</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('pass/resetpassword') }}">
                            {{ csrf_field() }}
                            <input style="display: none" type="text" class="form-control" name="id"  id="id" value="{{$check->id}}" readonly>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">您设置的问题是</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="question" name="question" value="{{$check->question}}">
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">答案</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="answer" id="answer">
                                    <div id="answer_errors"></div>
                                    <div id="answer_success"></div>
                                    @if ($errors->has('answer'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('answer') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="password" style="display: none" >
                                <div class="alert alert-warning" role="alert">密码不能少于6位，两次密码要一样，不然跳回上一页</div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">密码</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">确认密码</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password_confirmation">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i>确认修改密码
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('#answer').on('blur',function () {
               $.ajax({
                   type: "POST",
                   url: "/checkanswer",
                   data: {
                       _token: '{{csrf_token()}}',//防CSRF攻击
                        answer: $(this).val(),
                       id:$('#id').val(),
                       question:$('#question').val()
                   },
                   dataType: "json",
                   success: function (data) {
                       console.log(data);
                       if(data=='成功'){
                           var $item=$('<div class="alert alert-success" role="alert" style="margin-top: 10px">答案正确</div>');
                           $('#answer_success').append($item);
                            $('.password').css('display','block');
                       }else{
                           var $item=$('<div class="alert alert-danger" role="alert">答案错误</div>');
                           $('#answer_errors').append($item);
                           $('#answer_errors').delay(6000).hide(0);
                       }
                   }
               })
            })
        })
    </script>
@endsection
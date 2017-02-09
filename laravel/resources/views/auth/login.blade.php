<html lang="en">
<link rel="stylesheet" href="{{ URL::asset('/css/bootstrap.min.css') }}">
<script src="{{ URL::asset('/js/jquery-1.12.1.js') }}"></script>
<script src="{{ URL::asset('/js/bootstrap.min.js') }}"></script>
{{--<link rel="stylesheet" href="{{ URL::asset('/css/font-awesome.min.css') }}">--}}
<link rel="stylesheet" href="{{ URL::asset('/css/font-awesome.css') }}">
<link rel="stylesheet" href="{{ URL::asset('/css/home.css') }}">
<head>
    <title>驴友</title>
</head>
<body class='login'>
<div class='wrapper'>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">驴友</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">邮箱地址</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

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

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> 记住我
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i>登录
                                </button>

                                <a class="btn btn-link" href="{{ url('password/reset/')}}">忘记密码?</a>
                                <a class="btn btn-link" href="{{ url('auth/register') }}">注册</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
    {{--<div class='wrapper'>--}}
        {{--<div class='row'>--}}
            {{--<div class='col-lg-12'>--}}
                {{--<div class='brand text-center'>--}}
                    {{--<h1>--}}
                        {{--<div class='logo-icon'>--}}
                            {{--<i class='icon-beer'></i>--}}
                        {{--</div>--}}
                            {{--驴友--}}
                    {{--</h1>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class='row'>--}}
            {{--<div class='col-lg-12'>--}}
                {{--<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">--}}
                    {{--{{ csrf_field() }}--}}
                    {{--<fieldset class='text-center'>--}}
                        {{--<legend>登录您的账号</legend>--}}
                        {{--<div class='form-group'>--}}
                            {{--<input class='form-control' placeholder='请输出邮箱地址' type='email'>--}}
                        {{--</div>--}}
                        {{--<div class='form-group'>--}}
                            {{--<input class='form-control' placeholder='请输出密码' type='password'>--}}
                        {{--</div>--}}
                        {{--<div class='text-center'>--}}
                            {{--<div class='checkbox'>--}}
                                {{--<label>--}}
                                    {{--<input type='checkbox' name="remember">--}}
                                   {{--记住我在这台电脑上--}}
                                {{--</label>--}}
                            {{--</div>--}}
                            {{--<button type="submit" class="btn btn-primary">--}}
                                {{--<i class="fa fa-btn fa-sign-in"></i>登录--}}
                            {{--</button>--}}
                            {{--<br>--}}
                            {{--<a href="{{url('/password/reset')}}">忘记密码?</a>--}}
                            {{--<a  href="{{ url('auth/register') }}">或者注册</a>--}}
                        {{--</div>--}}
                    {{--</fieldset>--}}
                {{--</form>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</body>--}}
</html>


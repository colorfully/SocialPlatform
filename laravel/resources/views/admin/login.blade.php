<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ URL::asset('/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/css/AdminLTE.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/css/skin-blue.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{asset('/articles')}}"><b>驴友</b>后台管理</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">请输入您的账号</p>

        <form action="" method="post">
            {{csrf_field()}}
            <ul>
                @if(session('msg'))
                    {{session('msg')}}
                @endif
                @if(session('user'))
                    {{session('user')}}
                @endif</ul>

            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="username" placeholder="用户名">
                <span class="fa fa-user-o form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="password" placeholder="密码">
                <span class="fa fa-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false"
                                 style="position: relative;"><input type="checkbox"
                                                                    style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                <ins class="iCheck-helper"
                                     style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                            </div>
                            Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.login-box-body -->
</div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>驴友后台管理</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <script src="{{URL::asset('/js/jquery-1.12.1.js')}}"></script>
    <link rel="stylesheet" href="{{ URL::asset('/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/css/AdminLTE.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/css/skin-blue.css') }}">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <a href="index2.html" class="logo">
            <span class="logo-mini"><b>驴友</b></span>
            <span class="logo-lg"><b>驴友</b></span>
        </a>

        <nav class="navbar navbar-static-top" role="navigation">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
        </nav>
    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="http://localhost:8000/admin.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>管理员</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <ul class="sidebar-menu">
                <li class="header">导航</li>
                <li class="active"><a href="{{asset('admin/user')}}"><i class="fa fa-link"></i> <span>用户管理</span></a></li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i><span>管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{asset('admin/articles')}}">文章管理</a></li>
                        <li><a href="{{asset('admin/activity')}}">活动管理</a></li>
                        <li><a href="{{asset('admin/topics')}}">话题管理</a></li>
                    </ul>
                </li>
            </ul>
        </section>
    </aside>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
               驴友
                <small>管理描述</small>
            </h1>
            <ol class="breadcrumb">
               <a href="{{asset('admin/login')}}" ><button class="btn btn-default">退出</button></a>
            </ol>
        </section>
        <a href="#" onClick="javascript :history.back(-1);"><button class="btn btn-default" style="margin: 6px 0 0 12px"><i class="fa fa-mail-reply" style="margin-right:5px "></i>返回</button></a>
        <section class="content">
            @yield('content')
        </section>
    </div>
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
        </div>
        <strong>驴友 <a href="#">管理</a>.</strong>后台
    </footer>
    <aside class="control-sidebar control-sidebar-dark">
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
    </aside>
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="{{URL::asset('/js/jquery-1.12.1.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ URL::asset('/js/bootstrap.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('/js/app.js') }}"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>

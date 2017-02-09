<html lang="en">
<link rel="stylesheet" href="{{ URL::asset('/css/bootstrap.css') }}">
<script src="{{ URL::asset('/js/jquery-1.12.1.js') }}"></script>
<script src="{{ URL::asset('/js/home.js') }}"></script>
<script src="{{ URL::asset('/js/bootstrap.js') }}"></script>
<link rel="stylesheet" href="{{ URL::asset('/css/fileinput.css') }}">
<link rel="stylesheet" href="{{ URL::asset('/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('/css/font-awesome.css') }}">
<link rel="stylesheet" href="{{ URL::asset('/css/home.css') }}">
<link rel="stylesheet" href="{{ URL::asset('/css/AdminLTE.css') }}">
<head>
    <title>驴友</title>
</head>
<body class="zhi">
<!--
    网页头部
-->
<div role="navigation" class="zu-top" data-za-module="TopNavBar">
    <div class="zg-wrap modal-shifting clearfix" id="zh-top-inner">
        <span class="zu-top-link-logo">驴友</span>

        <div class="top-nav-profile">
            @if(Auth::guest())
                <a class="Avatar" href="{{asset('auth/login')}}">
                    <span class="zu-top-nav-link">登录</span>
                </a>
            @else
                <a href="{{asset('author/').'/'.Auth::user()->name}}" class="zu-top-nav-userinfo ">
                    <span class="name">{{Auth::user()->name}}</span>
                    <img class="Avatar" src="{{Auth::user()->head_ico}}" alt="{{Auth::user()->name}}"/>
                    @if($letter>0)
                        <span id="zh-top-nav-new-pm" class="zg-noti-number zu-top-nav-pm-count"
                              data-count="0">{{$letter}}
</span>
                    @else
                        <span id="zh-top-nav-pm-count" class="zu-top-nav-pm-count zg-noti-number"
                              style="display: none" data-count="0"></span>
                    @endif
                </a>
                <ul class="top-nav-dropdown" id="top-nav-profile-dropdown">
                    <li>
                        <a href="{{asset('author/').'/'.Auth::user()->name}}">
                            <i class="fa fa-user-o" style="margin:0 15px"></i>我的主页
                        </a>
                    </li>

                    <li>
                        <a href="{{asset('/letter')}}">
                            @if($letter>0)
                                <i class="fa fa-envelope-o" style="margin:0 15px"></i>私信
                                <span id="zh-top-nav-pm-count" class="zu-top-nav-pm-count zg-noti-number"
                                      data-count="0">{{$letter}}</span>
                            @else
                                <i class="fa fa-envelope-o" style="margin:0 15px"></i>私信
                                <span id="zh-top-nav-pm-count" class="zu-top-nav-pm-count zg-noti-number"
                                      style="display: none" data-count="0"></span>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="{{asset(('author/').'update/'.Auth::user()->id)}}">
                            <i class="fa fa-cog" style="margin:0 15px"></i>设置
                        </a>
                    </li>
                    <li>
                        <a href="{{asset('/author').'/'.Auth::user()->name.'/list?page=article'}}">
                            <i class="fa fa-file-archive-o" style="margin:0 15px"></i>个人管理
                        </a>
                    </li>
                    <li>
                        <a href="{{asset('auth/logout')}}">
                            <i class="fa fa-power-off" style="margin:0 15px"></i>退出
                        </a>
                    </li>
                </ul>
            @endif
        </div>
        <a href="{{asset('/topic/create')}}">
            <button class="zu-top-add-question" id="zu-top-add-question">提问</button>
        </a>
        <div role="search" id="zh-top-search" class="zu-top-search">
            <form method="get" action="{{action('Article\ArticleController@search')}}" id="zh-top-search-form"
                  class="zu-top-search-form">
                <label for="q" class="hide-text">知乎搜索</label><input type="text" class="zu-top-search-input" id="q"
                                                                    name="q" value="" placeholder="搜索你感兴趣的内容...">
                <button type="submit" class="zu-top-search-button"><i class="icon-search icon-2x"></i><span
                            class="hide-text">搜索</span><span class="sprite-global-icon-magnifier-dark"></span></button>
            </form>
        </div>
        <div id="zg-top-nav" class="zu-top-nav">
            <ul class="zu-top-nav-ul zg-clear">
                <li class="zu-top-nav-li" id="zh-top-nav-home">
                    <a class="zu-top-nav-link" href="{{asset('/home')}}" id="zh-top-link-home">首页</a>
                </li>
                <li class="top-nav-topic-selector zu-top-nav-li " id="zh-top-nav-topic">
                    <a class="zu-top-nav-link" href="{{asset('/topic')}}" id="top-nav-dd-topic">话题</a>
                </li>
                <li class="zu-top-nav-li " id="zh-top-nav-explore">
                    <a class="zu-top-nav-link" href="{{asset('/activity')}}">活动</a>
                </li>
                <li class="top-nav-noti zu-top-nav-li ">
                    <a class="zu-top-nav-link" href="{{asset('/applyList')}}" id="zh-top-nav-count-wrap"
                       role="button"><span class="mobi-arrow"></span>
                        申请 </a>

                </li>
                <li class="zu-top-nav-li " id="zh-top-nav-explore">
                    <a class="zu-top-nav-link" href="{{asset('/chatRoom')}}">聊天室</a>
                </li>
            </ul>
        </div>

    </div>
</div>
<div class="zg-wrap zu-main clearfix" role="main">
    <div class="zu-main-content">
        <div class="zu-main-content-inner">
            <div class="HomeEntry">
                <div class="HomeEntry-avatar">
                    <img class="Avatar Avatar-xs" src="{{Auth::user()->head_ico}}">
                </div>
                <div class="HomeEntry-box">
                            <span class="HomeEntry-boxArrow">
                            </span>
                    <ul class="HomeEntry-list">
                        <li class="HomeEntry-item">
                            <a class="HomeEntry-ask js-HomeEntry-ask" href="{{asset('/topic/create')}}">
                                <i class="fa fa-hand-paper-o"></i>
                                提问
                            </a>
                        </li>
                        <li class="HomeEntry-item">
                            <a class="HomeEntry-answer" href="{{asset('/activity/create')}}" target="_blank">
                                <i class="fa fa-group"></i>
                                发起活动
                            </a>
                        </li>
                        <li class="HomeEntry-item">
                            <a class="HomeEntry-post js-HomeEntry-post" href="{{asset('/articles/create')}}"
                               target="_blank">
                                <i class="icon-edit icon-large"></i>
                                写文章
                            </a>
                        </li>
                    </ul>
                    {{--<div class="HomeEntry-draft">--}}
                    {{--<a href="/draft" target="_blank"> 草稿 </a>--}}
                    {{--</div>--}}
                </div>
            </div>
            <!--
                    内容
             -->
            @yield('content')
        </div>
    </div>
    <div class="zu-main-sidebar">
        <div class="box">
            <!-- Profile Image -->
            <div class="box-body box-profile">
                <a href="{{asset('author/'.Auth::user()->name)}}">
                <img class="profile-user-img img-responsive img-circle" src="{{Auth::user()->head_ico}}"
                     alt="User profile picture">
                </a>
                <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        @if($layout_comments==0)
                        <b>有人回复你的评论</b><a class="pull-right" href="{{asset('/comment')}}">历史评论</a>
                        @endif
                        @if($layout_comments>0)
                            <b>有人回复你的评论</b> <a class="pull-right" href="{{asset('/comment')}}"><span id="zh-top-nav-pm-count"
                                                                class="zu-top-nav-pm-count zg-noti-number"
                                                                data-count="0">{{$layout_comments}}</span></a>
                        @endif
                    </li>
                    <li class="list-group-item">
                        <b>有人回答你的提问</b>
                        @if($topicTips>0)
                            <a class="pull-right" href="{{asset('/topic/MyTopic')}}"><span id="zh-top-nav-pm-count"
                                                                                   class="zu-top-nav-pm-count zg-noti-number"
                                                                                   data-count="0">{{$topicTips}}</span></a>
                        @endif
                    </li>
                    <li class="list-group-item">
                        <b>有人申请加入你的活动</b> <a class="pull-right" href=""></a>
                        @if($layout_apply>0)
                            <a class="pull-right" href="{{asset('/applyList')}}"><span id="zh-top-nav-pm-count"
                                                                                       class="zu-top-nav-pm-count zg-noti-number"
                                                                                       data-count="0">{{$layout_apply}}</span></a>
                        @endif
                    </li>
                    @if($chatRoom==true)
                        <li class="list-group-item">
                            <b>活动留言板</b> <a class="pull-right" href="{{asset('/chatRoom')}}"><span
                                        class="label label-danger">新消息</span></a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="box box-primary" style="margin-top: 20px">
            <div class="box-header with-border">
                <h3 class="box-title">随机文章</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @foreach($randArticle as $rand)
                    <strong><i class="fa fa-book margin-r-5"></i>文章标题</strong>

                    <p class="text-muted"><a style="float: left"
                                             href="/articles/{{$rand->id}}">
                            {{$rand->title}}</a>
                    </p>

                    <hr>

                    <strong><i class="fa fa-pencil margin-r-5"></i> 作者</strong>

                    <p class="text-muted"><a href="{{asset('author/').'/'.$rand->author}}">{{$rand->author}}</a></p>

                    <hr>

                    <strong><i class="fa fa-file-text-o margin-r-5"></i> 文章简介</strong>
                    <p>{{$rand->intro}}</p>
                    <hr>
                @endforeach
            </div>
            <!-- /.box-body -->
        </div>

        @yield('sidebar')
    </div>
</div>
</div>
<!--
    脚本
-->
<footer class="container col-xs-offset-2" style="clear: both">
    <p>by张泽商</p>
</footer>

</body>
</html>
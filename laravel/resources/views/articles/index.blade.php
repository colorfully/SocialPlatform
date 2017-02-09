@extends('layouts.app')
@section('content')
    <ul class="nav nav-tabs" role="tablist" id="myTab">
        <li role="presentation" class="active"><a href="#home" role="tab" data-toggle="tab" id="latest">最新发布</a></li>
        <li role="presentation"><a href="#profile" role="tab" data-toggle="tab" id="moment">朋友圈</a></li>
        <li role="presentation"><a href="#may" role="tab" data-toggle="tab" id="MyLike">推荐用户</a></li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
            @foreach($page as $article)
                <div class="article-list">
                    <div class="article-title">
                        <div class="container-fluid">
                            <div class="row">
                                <div style="float: left">
                                    @if($article->first_pic!=null)
                                        <img src="{{$article->first_pic}}" style="width: 200px;margin-right: 5px">
                                    @endif
                                </div>
                                <div>
                                    <span>
                                        <b style="font-size: 24px">
                                        <a style="margin-top:30px"
                                           href="/articles/{{$article->id}}">{{$article->title}}
                                        </a>
                                        </b>
                                    </span>
                                    <div style="padding: 5px">
                                        <h4><a href="/articles/{{$article->id}}"
                                               style="text-decoration: none">{{$article->intro}}....
                                            </a></h4>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="article-content">
                            {{--<div style="padding: 5px">--}}
                                {{--<h4><a href="/articles/{{$article->id}}"--}}
                                       {{--style="text-decoration: none">{{$article->intro}}--}}
                                    {{--</a></h4>--}}
                            {{--</div>--}}
                            {{--<div class="pic">--}}
                                {{--@if($article->first_pic!=null)--}}
                                    {{--<img src="{{$article->first_pic}}" style="width: 200px;margin-right: 5px">--}}
                                {{--@endif--}}
                                {{--@if($article->second_pic!=null)--}}
                                    {{--<img src="{{$article->second_pic}}" style="width: 200px;margin-right: 5px">--}}
                                {{--@endif--}}
                                {{--@if($article->third_pic!=null)--}}
                                    {{--<img src="{{$article->third_pic}}" style="width: 200px;margin-right: 5px">--}}
                                {{--@endif--}}
                            {{--</div>--}}
                            <div class="article-detail" style="text-align: right;margin-top: 5px">
                                <i class="fa fa-pencil-square-o"></i><a href="{{asset('author/').'/'.$article->author}}"><img class="head_ico_index" src="{{$article->head_ico}}"></a>
                                <span>
                                    <strong>{{$article->author}}</strong>
                               </span>
                                   <span><i class="fa fa-clock-o"
                                            style="margin-right: 3px"></i>{{date("Y-m-d",strtotime($article->published_at))}}</span>
                            </div>
                    </div>
                </div>
            @endforeach
                <div class="right">{!! $page->render() !!}</div>
        </div>
        <div role="tabpanel" class="tab-pane" id="profile">
        </div>
        <div role="tabpanel" class="tab-pane" id="may">

        </div>
    </div>
    <script>
        $(function () {
            var page = 0;
            var flag = false;
            var pages = 0;
            var flags = false;
            function getLocalTime(time) {
                return time.substr(0,10);
            }
            $('#moment').click(function (e) {
                $('#home').tab('show');
                if (!page) {
                    getInfo(page++)
                }
                flag = true;
                flags = false;
            });

            $('#latest').click(function () {
                $('#profile').tab('show');
                flag = false;
                flags = false;
            });

            $('#MyLike').click(function (e) {
                $('#may').tab('show');
                if (!pages) {
                    getUser(pages++)
                }
                flag = false;
                flags = true;
            });

            $(window).scroll(function () {
                totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());
                if ($(document).height() <= totalheight && flag) {
                    getInfo(page++);

                }

                if ($(document).height() <= totalheight && flags) {
                    getUser(pages++);
                }
            });

            function getInfo(page) {
                $.ajax({
                    type: "post",
                    url: "/FriendsCircle?page=" + page,
                    data: {
                        _token: '{{csrf_token()}}'//防CSRF攻击
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);

                        for (var i = 0; i < data.length; i++) {
                            var obj = data[i];

                            var img = '';

                            if (obj.first_pic != null) {
                                img += '<img src="' + obj.first_pic + '" style="width: 200px;margin-right: 5px">'
                            }
//                            if (obj.second_pic != null) {
//                                img += '<img src="' + obj.second_pic + '" style="width: 100px;margin-right: 10px">';
//                            }
//
//                            if (obj.third_pic != null) {
//                                img += '<img src="' + obj.third_pic + '" style="width: 100px;margin-right: 10px">';
//                            }
                            var $a=$('<div class="article-list"> <div class="article-title"> <div class="container-fluid"> <div class="row"> <div style="float: left">'+img+'</div> <div> <span> <b style="font-size: 24px"> <a style="margin-top:30px" href="/articles/' + obj.id + '">' + obj.title + '</a> </b> </span> <div style="padding: 5px"> <h4><a href="/articles/' + obj.id + '"style="text-decoration: none">' + obj.intro + '.... </a></h4> </div> </div> </div> </div> </div> <div class="article-content"> <div class="article-detail" style="text-align: right;margin-top: 5px"> <i class="fa fa-pencil-square-o"></i><a href="author/' + obj.author + '"><img class="head_ico_index" src="' + obj.head_ico + '"></a> <span> <strong>' + obj.author + '</strong> </span> <span><i class="fa fa-clock-o"style="margin-right: 3px"></i>' +getLocalTime(obj.published_at)+ '</span> </div> </div> </div>');
                            var $item = $(' <div class="article-list"><div class="article-title"> <div class="container-fluid"> <div class="row"> <div class="col-md-3"> <a href=" author/' + obj.author + '"><img class="head_ico_index" src="' + obj.head_ico + '"></a> <div class="text-left">' + obj.author + '</div> </div> <div class="col-md-6"> <h3><a style="float: left" href="/articles/' + obj.id + '">' + obj.title + '</a> </h3> </div> <div class="col-md-3"> <span><i class="icon-calendar"style="margin-right: 3px"></i>' + obj.published_at + '</span> </div> </div> </div> </div> <div class="article-content"> <div class="org_box"> <span class="org_bot_cor"></span> <div style="padding: 15px"> <h4><a href="/articles/' + obj.id + '" style="text-decoration: none">' + obj.intro + '</a></h4> </div> <div class="pic">' + img + '</div> </div> </div> </div>');
                            $('#profile').append($a);
                        }
                    }
                })
            }

            function getUser(pages) {
                $.ajax({
                    type: "post",
                    url: "/NewFriends?pages=" + pages,
                    data: {
                        _token: '{{csrf_token()}}'//防CSRF攻击
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        for (var i = 0; i < data.length; i++) {
                            var obj =data[i];
                            var usintro="";
                            if(obj.intro==null){
                                obj.intro='<div class="alert alert-info" role="alert">改用户还没有写简介</div>';
                            }
                            var $items = $('<div class="row"> <div class="col-md-4" style="margin-top: 15px;"><a href="/author/' + obj.name + '"><img class="img-circle img-responsive" src="'+obj.head_ico +'" style="width: 100px;padding: 3px;"></a></div> <div class="col-md-8" style="margin-top: 5px"> <div style="font-size: 20px;"><a href="/author/' + obj.name + '"><strong>'+obj.name+'</strong></a></div><div style="margin-bottom: 10px">'+obj.intro+'</div><div class="label label-success">他跟你点赞过同一篇文章</div> </div> </div>');
                            $('#may').append($items);
                        }
                    }
                })
            }
        });

    </script>
@endsection
@extends('layouts.app')
@section('content')
    <ul class="nav nav-pills nav-justified" role="tablist">
        <li role="presentation"><a href="{{asset('/topic')}}">话题广场</a></li>
        <li role="presentation"  class="active"><a href="{{asset('/topic/MyTopic')}}">我的话题</a></li>
    </ul>

    @foreach($topic as $topics)
        <div class="topic-list" style="margin-top: 20px">
            <div class="article-title col-md-2">
                <div >
                    <div class="col-md-3">
                        <img class="head_ico_index" src="{{$topics->head_ico}}">

                    </div>
                </div>
                <div style="text-align: center;clear:both ">
                    <a href="{{asset('author/').'/'.$topics->name}}">{{$topics->name}}</a>
                </div>
            </div>
            <div class="col-md-9">
                <div>
                    <div class="demo clearfix">
                        <span class="triangle "></span>
                        <div class="article">
                            @if($topics->tip==true)
                            <div style="padding: 15px"><h4><a href="/topic/{{$topics->id}}" style="text-decoration: none"><span class="shine">{{$topics->content}}</span></a></h4>
                                @else
                                    <div style="padding: 15px"><h4><a href="/topic/{{$topics->id}}" style="text-decoration: none">{{$topics->content}}</a></h4>
                                @endif
                            </div>
                            <div >
                                <div style="float: right;clear: both">
                                    {{date("Y-m-d  h:i:s",strtotime($topics->create_time))}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{--{!! $page->render() !!}--}}
@endsection
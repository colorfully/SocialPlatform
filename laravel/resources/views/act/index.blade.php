@extends('layouts.app')
@section('content')
    <ul class="nav nav-pills nav-justified" role="tablist">
        <li role="presentation" class="active"><a href="{{asset('/activity')}}">最新活动</a></li>
        <li role="presentation"><a href="{{asset('/activity/interest')}}">你可能喜欢的活动
            </a>
        </li>
    </ul>
    @foreach($Activity as $Activities)
        <div class="activity-list" style="margin-top: 10px">
            <div class="article-title">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{asset('author/').'/'.$Activities->name}}"><img class="head_ico_index"
                                                                                      src="{{$Activities->head_ico}}"></a>
                            <div class="text-left">
                                {{$Activities->name}}
                            </div>
                        </div>
                        <div class="col-md-9">
                                        <span class="right"><i class="icon-calendar"
                                                               style="margin-right: 3px"></i>{{date("Y-m-d H:i:s",strtotime($Activities->create_time))}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="article-content">
                <div class="org_box">
                    <span class="org_bot_cor"></span>
                    @if($Activities->cover!=null)
                        <div class="row">
                            <div class="col-md-2" style="padding: 5px">
                                <img src="{{$Activities->cover}}"
                                     style="border-radius: 10px;width: 100px;height: 100px">
                            </div>
                            <div class="col-md-6" style="padding: 10px">
                                <h4><a href="/activity/{{$Activities->id}}"
                                       style="text-decoration: none">{{$Activities->title}}
                                    </a></h4>
                            </div>
                        </div>
                    @else
                        <div style="padding: 10px">
                            <h4><a href="/activity/{{$Activities->id}}"
                                   style="text-decoration: none">{{$Activities->title}}
                                </a></h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    {!! $Activity->render() !!}
@endsection
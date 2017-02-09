@extends('layouts.app')
@section('content')
   <div><h4>私信列表</h4></div>
   <div class="private_list">
    @foreach($private as $privater)
        <div style="float: left;width:20%">
        <a href="{{asset('letter/show=').$privater->id.'other='.$privater->mine_id}}" style="text-decoration: none">
            <img src="{{$privater->head_ico}}" class="head_ico_index">
        </a>
        @if($privater->status==0)
            <span id="zh-top-nav-pm-count" class="zu-top-nav-pm-count zg-noti-number"
                  data-count="0">有信息</span>
        @else
        @endif
        <div class="text-left">{{$privater->name}}</div>
        </div>
    @endforeach
   </div>
@endsection
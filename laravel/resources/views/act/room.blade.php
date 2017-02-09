@extends('layouts.app')
@section('content')
    <h4>聊天室</h4>
    <div style="margin-top: 10px;padding: 5px">
        @foreach($room as $ChatRoom)
            <div style="float: left;width: 20%;margin:0 auto;">
                @if(isset($ChatRoom->new))
                    <span class="label label-danger">有新消息</span>
                @endif
                <div style="text-align: center"><a href="{{asset('/chatRoom/'.$ChatRoom->id)}}" style="width: 50px"><img
                                src="http://localhost:8000/chatroom.png" style="width: 100px;margin:0 auto;">
                    </a></div>
                <div style="margin:0 auto;text-align: center;word-break:break-all;">{{$ChatRoom->title}}</div>
            </div>

        @endforeach
    </div>
@endsection
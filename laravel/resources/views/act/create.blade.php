@extends('layouts.common')
@section('content')
    @include('editor::head')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>发起活动</h3>
        </div>
        <div class="panel-body">
            <form action="{{asset('/activity/store')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title">标题</label>
                    <input type="text" name="title" class="form-control" value="{{old('title')}}">
                    @if ($errors->has('title'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="name">发起人</label>
                    <input name="name" type="text" class="form-control" value="{{Auth::user()->name}}" readonly>
                </div>
                <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                    <label for="content">内容</label>
                    <div class="alert alert-info" role="alert">请在内容处，简述下你的活动的相关流程和内容</div>
                    <div class="editor">
                        <textarea id='myEditor' name="content" >{{old('content')}}</textarea>
                        @if ($errors->has('content'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">提交</button>
                </div>
            </form>
        </div>
    </div>
@endsection
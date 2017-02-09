@extends('layouts.common')
@section('content')
    @include('editor::head')
    <div class="panel panel-default">
        <div class="panel-heading">
            {{ $article->title }}
        </div>
        <div class="panel-body">
            <form action="/articles/{{$article->id}}/update" method="post">
                {{csrf_field()}}
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title">标题</label>
                    <input type="text" name="title" class="form-control" value="{{$article->title}}">
                    @if ($errors->has('title'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                    <label for="content">内容</label>
                    <div class="editor">
                        <textarea id='myEditor' name="content">{{$article->content }}</textarea>
                        @if ($errors->has('content'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('published_at') ? ' has-error' : '' }}">
                    <label for="published_at">发布日期</label>
                    <input name="published_at" type="date" class="form-control"
                           value="{{date("Y-m-d",strtotime($article->published_at))}}">
                    @if ($errors->has('published_at'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('published_at') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default">确认</button>
                </div>
            </form>
        </div>
    </div>
@endsection

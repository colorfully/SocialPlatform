@extends('layouts.common')
@section('content')
    @include('editor::head')
    <div class="panel panel-default">
        <div class="panel-heading">
        <h3>写文章</h3>
        </div>
        <div class="panel-body">
         <form action="/articles/store" method="post">
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
             <div class="form-group{{ $errors->has('published_at') ? ' has-error' : '' }}">
                 <label for="published_at">发布日期</label>
                 <input  name="published_at" type="date" class="form-control">
                 @if ($errors->has('published_at'))
                     <span class="help-block">
                                        <strong>{{ $errors->first('published_at') }}</strong>
                                    </span>
                 @endif
             </div>
             <div class="form-group">
                 <label for="author">作者</label>
                 <input  name="author" type="text" class="form-control" value="{{Auth::user()->name}}" readonly>
             </div>

             <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                 <label for="content">内容</label>
                 <div class="alert alert-danger" role="alert">内容处插入一张图片作为文章封面</div>
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
                <button type="submit" class="btn btn-default">发表文章</button>
             </div>
             </form>
            </div>
        </div>
@endsection

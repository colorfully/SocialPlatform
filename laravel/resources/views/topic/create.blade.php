
@extends('layouts.common')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>创建话题</h3>
        </div>
        <div class="panel-body">
            <form action="{{asset('topic/create')}}" method="post">
                {{csrf_field()}}
                <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                    <label for="content">内容</label>
                    <textarea name="content" rows="4"  class="form-control">{{old('content')}}</textarea>
                    @if ($errors->has('content'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">发表话题</button>
                </div>
            </form>
        </div>
    </div>
@endsection
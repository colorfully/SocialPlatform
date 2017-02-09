@extends('layouts.app')
@section('content')
    <div class="text-center">
    <img  class="head_ico" src="{{Auth::user()->head_ico}}">
    </div>
    <fieldset style="border: 1px solid #f0f0f0;padding: 10px ;margin: 10px 0 20px 0">
     <form action="" method="post">
         {{csrf_field()}}
         <input type="text" hidden value="update_msg" name="action">
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name">用户名:</label>
        <input type="text" class="form-control" id="name" name="name" value="{{Auth::user()->name}}">
        @if ($errors->has('name'))
            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
        @endif
    </div>
    <div class="form-group">
        <label for="intro">介绍:</label>
        <textarea  rows="4" class="form-control" id="intro" name="intro">{{Auth::user()->intro}}</textarea>
    </div>
         <div class="form-group" style="float: right">
             <button type="submit" class="btn btn-primary">修改</button>
         </div>
     </form>
    </fieldset>
    <fieldset style="border: 1px solid #f0f0f0;padding: 10px">更换头像
    <form action="" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="text" hidden value="update_head_ico" name="action">
    <div  class="form-group">
        <input  id="inputFile" type="file" class="form-control file" name="pic">
    </div>
    </form>
    </fieldset>
    <script src="{{ URL::asset('/js/fileinput.js') }}"></script>
    <script src="{{ URL::asset('/js/zh.js') }}"></script>
    <script>
        //初始化fileinput控件
        $("#inputFile").fileinput({
            language: 'zh',
            autoReplace: false,
            maxFileCount: 1,
            allowedFileExtensions: ["jpg", "png", "gif"],
            browseClass: "btn btn-primary", //按钮样式
            previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
           // showUpload: false, //若为同步提交，无需显示组件的上传按钮
        });
    </script>
        <!-- 上传图片div /S-->

    @endsection
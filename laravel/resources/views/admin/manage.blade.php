@extends('admin.index')
@section('content')
    @if($category=='user')
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">用户列表</h3>
                <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control pull-right search_content" placeholder="查找用户名">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default search"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                                   aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1"
                                        aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending"
                                        style="width: 181px;">编号
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Browser: activate to sort column ascending" style="width: 224px;">
                                        用户名
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 197px;">邮箱
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Engine version: activate to sort column ascending"
                                        style="width: 154px;">操作
                                    </th>
                                </thead>
                                <tbody>
                                @foreach($result as $user)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            <a href="{{asset('admin/info/user/'.$user->id)}}">
                                                <button class="btn btn-info" style="margin-right: 10px"><i
                                                            class="fa fa-eye"></i></button>
                                            </a>
                                            <a href="{{asset('admin/Destroy/user/'.$user->id)}}">
                                                <button class="btn btn-danger"><i
                                                            class="fa fa-trash-o"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1
                                to {{$show_num}}
                                of {{ $count}} entries
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="right">{!! $result->render() !!}</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    @elseif($category=='articles')
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">文章列表</h3>
                <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control pull-right" placeholder="搜索文章标题">

                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default search"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                                   aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1"
                                        aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending"
                                        style="width: 181px;">编号
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Browser: activate to sort column ascending" style="width: 224px;">标题
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 197px;">作者
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 197px;">文章发布时间
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Engine version: activate to sort column ascending"
                                        style="width: 154px;">操作
                                    </th>
                                </thead>
                                <tbody>
                                @foreach($result as $article)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{$article->id}}</td>
                                        <td>{{$article->title}}</td>
                                        <td>{{$article->author}}</td>
                                        <td>{{date("Y-m-d",strtotime($article->published_at))}}</td>
                                        <td>
                                            <a href="{{asset('admin/info/article/'.$article->id)}}">
                                                <button class="btn btn-info" style="margin-right: 10px"><i
                                                            class="fa fa-eye"></i></button>
                                            </a>
                                            <a href="{{asset('admin/info/comment/'.$article->id)}}">
                                                <button class="btn btn-warning" style="margin-right: 10px"><i
                                                            class="fa fa-comment-o"></i></button>
                                            </a>
                                            <a href="{{asset('admin/Destroy/article/'.$article->id)}}">
                                                <button class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1
                                to {{$show_num}}
                                of {{$count}} entries
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="right">{!! $result->render() !!}</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    @elseif($category=='topics')
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">话题列表</h3>
                <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control pull-right" placeholder="搜索话题标题">

                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default search"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                                   aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1"
                                        aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending"
                                        style="width: 181px;">编号
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Browser: activate to sort column ascending" style="width: 224px;">内容
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 197px;">作者
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 197px;">日期
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Engine version: activate to sort column ascending"
                                        style="width: 154px;">操作
                                    </th>
                                </thead>
                                <tbody>
                                @foreach($result as $list)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{$list->id}}</td>
                                        <td>{{$list->content}}</td>
                                        <td>{{$list->name}}</td>
                                        <td>{{date("Y-m-d",strtotime($list->create_time))}}</td>
                                        <td>
                                            <a href="{{asset('admin/info/topic/'.$list->id)}}">
                                                <button class="btn btn-info" style="margin-right: 10px"><i
                                                            class="fa fa-eye"></i></button>
                                            </a>
                                            <a href="{{asset('admin/info/topic_reply/'.$list->id)}}">
                                                <button class="btn btn-warning" style="margin-right: 10px"><i
                                                            class="fa fa-comment-o"></i></button>
                                            </a>
                                            <a href="{{asset('admin/Destroy/topic/'.$list->id)}}">
                                                <button class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1
                                to {{$show_num}}
                                of {{$count}} entries
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="right">{!! $result->render() !!}</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    @elseif($category=='activity')
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">活动列表</h3>
                <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control pull-right" placeholder="搜索活动标题">

                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default search"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                                   aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1"
                                        aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending"
                                        style="width: 181px;">编号
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Browser: activate to sort column ascending" style="width: 224px;">标题
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 197px;">作者
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 197px;">日期
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Engine version: activate to sort column ascending"
                                        style="width: 154px;">操作
                                    </th>
                                </thead>
                                <tbody>
                                @foreach($result as $list)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{$list->id}}</td>
                                        <td>{{$list->title}}</td>
                                        <td>{{$list->name}}</td>
                                        <td>{{date("Y-m-d",strtotime($list->create_time))}}</td>
                                        <td>
                                            <a href="{{asset('admin/info/activity/'.$list->id)}}">
                                                <button class="btn btn-info" style="margin-right: 10px"><i
                                                            class="fa fa-eye"></i></button>
                                            </a>
                                            <a href="{{asset('admin/info/chatroom/'.$list->id)}}">
                                                <button class="btn btn-warning" style="margin-right: 10px"><i
                                                            class="fa fa-comment-o"></i></button>
                                            </a>
                                            <a href="{{asset('admin/Destroy/activity/'.$list->id)}}">
                                                <button class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1
                                to {{$show_num}}
                                of {{$count}} entries
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="right">{!! $result->render() !!}</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    @endif
    <script>
        $(function (){
            $('.search').on('click',function(){
                $.ajax({
                    type: "post",
                    url: "/admin/search",
                    data: {
                        _token: '{{csrf_token()}}',//防CSRF攻击
                        search: $("input[name='table_search']").val(),
                        category: '{{$category}}'
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        if('{{$category}}'=='user'){
                                var $item = $('<tr role="row" class="danger" > <td class="sorting_1">' + data.id + '</td> <td>' + data.name + '</td> <td>' + data.email + '</td> <td> <a href="http://localhost:8000/admin/info/user/' + data.id + '"> <button class="btn btn-info" style="margin-right: 10px"><i class="fa fa-eye"></i></button> </a><a href="http://localhost:8000/admin/Destroy/user/' + data.id + '"> <button class="btn btn-danger"><i class="fa fa-trash-o"></i></button> </a> </td> </tr>');
                        }else if('{{$category}}'=='articles'){
                            var $item=$('<tr role="row" class="danger"> <td class="sorting_1">'+data.id+'</td> <td>'+data.title+'</td> <td>'+data.author+'</td> <td>'+data.published_at+'</td> <td> <a href="http://localhost:8000/admin/info/article/'+data.id+'"> <button class="btn btn-info" style="margin-right: 10px"><i class="fa fa-eye"></i></button> </a> <a href="http://localhost:8000/admin/info/comment/'+data.id+'"> <button class="btn btn-warning" style="margin-right: 10px"><i class="fa fa-comment-o"></i></button> </a> <a href="http://localhost:8000/admin/Destroy/article/'+data.id+'"> <button class="btn btn-danger"><i class="fa fa-trash-o"></i></button> </a> </td> </tr>');
                        }else if('{{$category}}'=='activity'){
                            var $item=$('<tr role="row" class="danger"> <td class="sorting_1">'+data.id+'</td> <td>'+data.title+'</td> <td>'+data.name+'</td> <td>'+data.create_time+'</td> <td> <a href="http://localhost:8000/admin/info/activity/'+data.id+'"> <button class="btn btn-info" style="margin-right: 10px"><i class="fa fa-eye"></i></button> </a><a href="http://localhost:8000/admin/info/chatroom/'+data.id+'"><button class="btn btn-warning" style="margin-right: 10px"><i class="fa fa-comment-o"></i></button> </a> <a href="http://localhost:8000/admin/Destroy/activity/'+data.id+'"> <button class="btn btn-danger"><i class="fa fa-trash-o"></i></button> </a> </td> </tr>');
                        }else if('{{$category}}'=='topics'){
                            var $item=$('<tr role="row" class="danger"> <td class="sorting_1">'+data.id+'</td> <td>'+data.content+'</td> <td>'+data.name+'</td> <td>'+data.create_time+'</td> <td> <a href="http://localhost:8000/admin/info/topic/'+data.id+'"> <button class="btn btn-info" style="margin-right: 10px"><i class="fa fa-eye"></i></button> </a> <a href="http://localhost:8000/admin/info/topic_reply/'+data.id+'"> <button class="btn btn-warning" style="margin-right: 10px"><i class="fa fa-comment-o"></i></button> </a> <a href="http://localhost:8000/admin/Destroy/topic/'+data.id+'"> <button class="btn btn-danger"><i class="fa fa-trash-o"></i></button></a></td></tr>');
                        }
                        $("thead").append($item);
                        $("input[name='table_search']").val("");
                    },
                    error: function (data) {

                    }
                });

            })
        })
    </script>
@endsection
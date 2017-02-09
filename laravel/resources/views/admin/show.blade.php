@extends('admin.index')
@section('content')
    @if(isset($result))
        @if($category=='user')
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><img src="{{$result->head_ico}}" style="width: 50px">{{$result->name}}</h3>
                </div>
                <div class="box-body">

                    <div class="form-group">
                        <label>邮箱:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-envelope-o"></i>
                            </div>
                            <input type="email" class="form-control pull-right" id="email" value="{{$result->email}}">
                        </div>

                    </div>
                    <div class="form-group">
                        <label>个人简介:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-id-card-o"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="{{$result->intro}}">
                        </div>

                    </div>
                    <div class="form-group">
                        <label>密码:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-lock"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="{{$result->password}}">
                        </div>

                    </div>
                    <div class="form-group">
                        <label>创立时间:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input type="date" class="form-control"
                                   value="{{date("Y-m-d",strtotime($result->created_at))}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>最近登录时间:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input type="datetime" class="form-control"
                                   value="{{date("Y-m-d H:i:s",strtotime($result->updated_at))}}">
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        @elseif($category=='article')
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{$result->title}}</h3>
                </div>
                <div class="box-body">

                    <div class="form-group">
                        <label>作者:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-user-o"></i>
                            </div>
                            <input type="email" class="form-control pull-right" id="email" value="{{$result->author}}">
                        </div>

                    </div>
                    <div class="form-group">
                        <label>文章简介:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-edit"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="{{$result->intro}}">
                        </div>

                    </div>
                    <div class="form-group">
                        <label>点赞数:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-thumbs-o-up"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="{{$result->like}}">
                        </div>

                    </div>
                    <div class="form-group">
                        <label>创立时间:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input type="datetime" class="form-control"
                                   value="{{date("Y-m-d H:i:s",strtotime($result->created_at))}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>发布时间:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input type="date" class="form-control"
                                   value="{{date("Y-m-d",strtotime($result->published_at))}}">
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        @elseif($category=='comment')
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">评论列表</h3>
                    {{--<div class="box-tools">--}}
                        {{--<div class="input-group input-group-sm" style="width: 150px;">--}}
                            {{--<input type="text" name="table_search" class="form-control pull-right" placeholder="Search">--}}

                            {{--<div class="input-group-btn">--}}
                                {{--<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>编号</th>
                            <th>评论者</th>
                            <th>日期</th>
                            <th>评论内容</th>
                            <th>操作</th>
                        </tr>
                        @foreach($result as $results)
                            <tr>
                                <td>{{$results->id}}</td>
                                <td>{{$results->name}}</td>
                                <td>{{date("Y-m-d H:i:s",strtotime($results->create_time))}}</td>
                                <td>{{$results->content}}</td>
                                <td><a href="{{asset('admin/Destroy/comment/'.$results->id)}}">
                                        <button class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    </a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="col-md-offset-10">{!! $result->render() !!}</div>
                <!-- /.box-body -->
            </div>
        @elseif($category == 'topic')
        @elseif($category=='topic_reply')
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">评论列表</h3>

                    {{--<div class="box-tools">--}}
                        {{--<div class="input-group input-group-sm" style="width: 150px;">--}}
                            {{--<input type="text" name="table_search" class="form-control pull-right" placeholder="Search">--}}

                            {{--<div class="input-group-btn">--}}
                                {{--<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>编号</th>
                            <th>评论者</th>
                            <th>日期</th>
                            <th>评论内容</th>
                            <th>操作</th>
                        </tr>
                        @foreach($result as $results)
                            <tr>
                                <td>{{$results->id}}</td>
                                <td>{{$results->name}}</td>
                                <td>{{date("Y-m-d H:i:s",strtotime($results->create_time))}}</td>
                                <td>{{$results->content}}</td>
                                <td><a href="{{asset('admin/Destroy/topic_reply/'.$results->id)}}">
                                        <button class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    </a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="col-md-offset-10">{!! $result->render() !!}</div>
                <!-- /.box-body -->
            </div>
        @elseif($category == 'activity')
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><img src="{{$result->cover}}" style="width: 50px">{{$result->title}}</h3>
                </div>
                <div class="box-body">

                    <div class="form-group">
                        <label>作者:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-user-o"></i>
                            </div>
                            <input type="email" class="form-control pull-right" id="email" value="{{$result->name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>活动内容:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-edit"></i>
                            </div>
                            <div class="form-control pull-right"
                                 style="OVERFLOW-Y: auto; OVERFLOW-X: hidden;  height: 300px"
                                 align=left>{!!  $content  !!}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>参与人数:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-thumbs-o-up"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="{{$result->num}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>日期:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input type="date" class="form-control"
                                   value="{{date("Y-m-d",strtotime($result->create_time))}}">
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        @elseif($category=='chatroom')
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">聊天室列表</h3>
                    {{--<div class="box-tools">--}}
                        {{--<div class="input-group input-group-sm" style="width: 150px;">--}}
                            {{--<input type="text" name="table_search" class="form-control pull-right" placeholder="Search">--}}

                            {{--<div class="input-group-btn">--}}
                                {{--<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>编号</th>
                            <th>用户名</th>
                            <th>日期</th>
                            <th>聊天内容</th>
                            <th>操作</th>
                        </tr>
                        @foreach($result as $results)
                            <tr>
                                <td>{{$results->id}}</td>
                                <td>{{$results->name}}</td>
                                <td>{{date("Y-m-d H:i:s",strtotime($results->create_time))}}</td>
                                <td>{{$results->content}}</td>
                                <td><a href="{{asset('admin/Destroy/chatroom/'.$results->id)}}">
                                        <button class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    </a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="col-md-offset-10">{!! $result->render() !!}</div>
                <!-- /.box-body -->
            </div>
        @endif
    @else
        <div class="alert alert-danger" role="alert">没有该信息!请返回查看其他内容</div>
    @endif

@endsection
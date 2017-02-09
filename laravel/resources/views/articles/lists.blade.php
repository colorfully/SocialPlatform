@extends('layouts.app')
@section('content')
    {{--{{ $title }}--}}
    @if($_GET['page']=='article')
        <ul class="nav nav-tabs nav-justified" role="tablist" style="margin-bottom: 10px">
            <li role="presentation" class="active"><a href="?page=article">文章</a></li>
            <li role="presentation"><a href="?page=activity">我的活动</a></li>
            <li role="presentation"><a href="?page=join">参与活动</a></li>
            <li role="presentation"><a href="?page=apply">申请</a></li>
            <li role="presentation"><a href="?page=topic">话题</a></li>
        </ul>
        @if($article!=null)

            <table class="table table-hover">
                <tr>
                    <th>标题</th>
                    <th>发布日期</th>
                    <th>操作</th>
                </tr>
                @foreach($article as $article)
                    <tr>
                        <td>{{$article->title}}</td>
                        <td>{{date("Y-m-d",strtotime($article->published_at))}}</td>
                        <td>
                            <button class="btn btn-default"><a href="{{asset('/articles').'/'.$article->id.'/edit'}}"
                                                               style="text-decoration: none"><i class="fa fa-edit"></i></a>
                            </button>
                            <button class="btn btn-default"><a href="{{asset('/author').'/'.$article->id.'/delete'}}"
                                                               style="text-decoration: none"><i
                                            class="fa fa-trash-o"></i></a></button>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <div class="alert alert-warning" role="alert">目前您还没有文章</div>
        @endif
    @endif
    @if($_GET['page']=='activity')
        <ul class="nav nav-tabs nav-justified" role="tablist" style="margin-bottom: 10px">
            <li role="presentation"><a href="?page=article">文章</a></li>
            <li role="presentation" class="active"><a href="?page=activity">我的活动</a></li>
            <li role="presentation"><a href="?page=join">参与活动</a></li>
            <li role="presentation"><a href="?page=apply">申请</a></li>
            <li role="presentation"><a href="?page=topic">话题</a></li>
        </ul>
        @if($activity!=null)
            <table class="table table-hover">
                <tr>
                    <th>标题</th>
                    <th>发布日期</th>
                    <th>操作</th>
                </tr>
                @foreach($activity as $activities)
                    <tr>
                        <td>{{$activities->title}}</td>
                        <td>{{$activities->create_time}}</td>
                        <td>
                            <button class="btn btn-default"><a href="{{asset('/activity').'/'.$activities->id}}"
                                                                                                                  style="text-decoration: none"><i
                                            class="fa fa-eye"></i></a></button>
                            <button class="btn btn-default"><a href="?page=manger&activity={{$activities->id}}"
                                                               style="text-decoration: none"><i
                                            class="fa fa-users"></i></a></button>
                            <button class="btn btn-default"><a
                                        href="{{asset('/activity').'/'.$activities->id.'/delete'}}"
                                        style="text-decoration: none"><i class="fa fa-trash-o"></i></a></button>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <div class="alert alert-warning" role="alert">目前创建任何活动</div>
        @endif
    @endif
    @if($_GET['page']=='join')
        <ul class="nav nav-tabs nav-justified" role="tablist" style="margin-bottom: 10px">
            <li role="presentation"><a href="?page=article">文章</a></li>
            <li role="presentation"><a href="?page=activity">我的活动</a></li>
            <li role="presentation" class="active"><a href="?page=join">参与活动</a></li>
            <li role="presentation"><a href="?page=apply">申请</a></li>
            <li role="presentation"><a href="?page=topic">话题</a></li>
        </ul>
        @if($act!=null)
            <table class="table table-hover">
                <tr>
                    <th>标题</th>
                    <th>发布日期</th>
                    <th>操作</th>
                </tr>
                @foreach($act as $activities)
                    <tr>
                        <td>{{$activities->title}}</td>
                        <td>{{$activities->create_time}}</td>
                        <td>
                            <button class="btn btn-default"><a href="{{asset('/activity').'/'.$activities->id}}"
                                                               style="text-decoration: none"><i
                                            class="fa fa-eye"></i></a></button>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <div class="alert alert-warning" role="alert">目前您还没有参与活动</div>
        @endif
    @endif
    @if($_GET['page']=='apply')
        <ul class="nav nav-tabs nav-justified" role="tablist" style="margin-bottom: 10px">
            <li role="presentation"><a href="?page=article">文章</a></li>
            <li role="presentation"><a href="?page=activity">我的活动</a></li>
            <li role="presentation"><a href="?page=join">参与活动</a></li>
            <li role="presentation" class="active"><a href="?page=apply">申请</a></li>
            <li role="presentation"><a href="?page=topic">话题</a></li>
        </ul>
        @if($apply!=null)
            @foreach($apply as $a)
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                {{$a->title}}
                            </div>
                            <div class="col-md-6">
                                申请人:{{$a->applicant_name}}
                                时间:{{$a->create_time}}
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div>
                            申请原因:{{$a->apply_reason}}
                        </div>
                        <div>
                            联系方式(微信或者电话):{{$a->contact}}
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-success left"
                                            disabled="disabled">{{$a->status}}</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-warning" role="alert">目前您还没有申请任何活动</div>
        @endif
    @endif
    @if($_GET['page']=='topic')
        <ul class="nav nav-tabs nav-justified" role="tablist" style="margin-bottom: 10px">
            <li role="presentation"><a href="?page=article">文章</a></li>
            <li role="presentation"><a href="?page=activity">我的活动</a></li>
            <li role="presentation"><a href="?page=join">参与活动</a></li>
            <li role="presentation"><a href="?page=apply">申请</a></li>
            <li role="presentation" class="active"><a href="?page=topic">话题</a></li>
        </ul>
        @if($topic!=null)
            <table class="table table-hover">
                <tr>
                    <th>标题</th>
                    <th>发布日期</th>
                    <th>操作</th>
                </tr>
                @foreach($topic as $top)
                    <tr>
                        <td>{{$top->content}}</td>
                        <td>{{$top->create_time}}</td>
                        <td>
                            <button class="btn btn-default"><a href="{{asset('/topic').'/'. $top->id}}"
                                                               style="text-decoration: none"><i
                                            class="fa fa-eye"></i></a></button>
                            <button class="btn btn-default"><a href="{{asset('/topic').'/'. $top->id.'/delete'}}"
                                                               style="text-decoration: none"><i
                                            class="fa fa-trash-o"></i></a></button>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <div class="alert alert-warning" role="alert">目前发表任何问题</div>
        @endif
    @endif
    @if($_GET['page']=='manger')
        <ul class="nav nav-tabs nav-justified" role="tablist" style="margin-bottom: 10px">
            <li role="presentation"><a href="?page=article">文章</a></li>
            <li role="presentation" class="active"><a href="?page=activity">我的活动</a></li>
            <li role="presentation" ><a href="?page=join">参与活动</a></li>
            <li role="presentation"><a href="?page=apply">申请</a></li>
            <li role="presentation" ><a href="?page=topic">话题</a></li>
        </ul>
        @if($member!=null)
            <table class="table table-hover">
                <tr>
                    <th>用户名</th>
                    <th>操作</th>
                </tr>
                @foreach($member as $people)
                    <tr>
                        <td>{{$people->name}}</td>
                        @if($people->id!=Auth::user()->id)
                        <td>
                            <button class="btn btn-default"><a href="{{asset('/author').'/'. $people->name}}"
                                                               style="text-decoration: none"><i
                                            class="fa fa-eye"></i></a></button>
                            <button class="btn btn-default"><a href="{{asset('/activity/delete').'/'. $_GET['activity'].'/'.$people->id}}"
                                                               style="text-decoration: none"><i
                                            class="fa fa-trash-o"></i></a></button>
                        </td>
                            @else
                            <td>
                                创办者
                            </td>
                        @endif
                    </tr>
                @endforeach
            </table>
            @else
            <div class="alert alert-warning" role="alert">您的活动目前还没有人</div>
            @endif
    @endif
@endsection


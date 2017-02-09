@extends('layouts.app')
@section('content')
    <div class="panel-body">
        @include('common.errors')
        <form action="/task" method="post" class="form-horizontal">
            {{csrf_field()}}
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Task</label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="icon-plus"></i> 增加任务
                    </button>
                </div>
            </div>
        </form>
    </div>
    @if(count($tasks)>0)
        <div class="panel panel-default">
            <div class="panel-heading">
                目前任务
            </div>
            <div class="panel-body">
                <table class="table table-striped task-table">
                    <thead>
                        <th>Task</th>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td class="table-text">
                                    <div>{{$task->name}}</div>
                                </td>
                                <td>
                                    <form action="/task/{{$task->id}}" method="post">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button>删除任务</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    @endsection
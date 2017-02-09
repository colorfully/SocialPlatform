@extends('layouts.app')
@section('content')
    @foreach($apply as $applicant)
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                        活动:{{$applicant->title}}
                    </div>
                    <div class="col-md-6">
                        申请人:<a href="{{asset('author/').$applicant->applicant_name}}">{{$applicant->applicant_name}}</a>
                        时间:{{$applicant->create_time}}
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div>
                    申请原因:{{$applicant->apply_reason}}
                </div>
                <div>
                    联系方式(微信或者电话):{{$applicant->contact}}
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-6">
                            @if($applicant->status=='已通过')
                                <button type="button" class="btn btn-success left"
                                        disabled="disabled">{{$applicant->status}}</button>
                            @elseif($applicant->status=='未通过')
                                <button type="button" class="btn btn-danger left"
                                        disabled="disabled">{{$applicant->status}}</button>
                            @else
                                <button type="button" class="btn btn-warning left"
                                        disabled="disabled">{{$applicant->status}}</button>
                            @endif
                        </div>
                        @if($applicant->status=='已通过'||$applicant->status=='未通过')
                        @else
                            <div class="col-md-6">
                                <button type="button" class="btn btn-primary right pass" style="margin-left: 10px"
                                        activity_id="{{$applicant->activity_id}}"
                                        applicant_id="{{$applicant->applicant_id}}"
                                        applicants_id="{{$applicant->id}}">
                                    通过
                                </button>
                                <button type="button" class="btn btn-primary right refuse"
                                        activity_id="{{$applicant->activity_id}}"
                                        applicant_id="{{$applicant->applicant_id}}"
                                        applicants_id="{{$applicant->id}}">拒绝
                                </button>
                            </div>
                        @endif
                    </div>

                </div>
            </div>

        </div>
    @endforeach
    <script>
        $(function () {
            $('.pass').on('click', function () {
                $.ajax({
                    type: "post",
                    url: "/applyPass",
                    data: {
                        _token: '{{csrf_token()}}',//防CSRF攻击
                        activity_id: $(this).attr('activity_id'),
                        applicant_id: $(this).attr('applicant_id'),
                        applicants_id: $(this).attr('applicants_id')
                    },
                    dataType: "json",
                    success: function (data) {
                        location.reload();
                    },
                    error: function (data) {
                    }
                });
            });
            $('.refuse').on('click', function () {
                $.ajax({
                    type: "post",
                    url: "/applyRefuse",
                    data: {
                        _token: '{{csrf_token()}}',//防CSRF攻击
                        activity_id: $(this).attr('activity_id'),
                        applicant_id: $(this).attr('applicant_id'),
                        applicants_id: $(this).attr('applicants_id')
                    },
                    dataType: "json",
                    success: function (data) {
                        location.reload();
                    },
                    error: function (data) {
                    }
                })
            });
        });
    </script>
@endsection
<?php

namespace App\Http\Controllers\Act;

use App\Applicant;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $check = Applicant::select('applicants.*', 'activities.name', 'activities.title', 'users.head_ico')->join('activities', 'applicants.activity_id', '=', 'activities.id')->join('users', 'applicants.applicant_id', '=', 'users.id')->where('activities.name', '=', Auth::user()->name)->orderby('applicants.create_time','desc')->get();
        return view('act.applyList', [
            'apply' => $check
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function refuse()
    {
        $id = $_POST['applicants_id'];
        DB::table('applicants')->where('id', '=', $id)->update(['status' => '未通过']);
        $data = 'ok';
        return json_encode($data);
    }


    public function pass()
    {
        $id = $_POST['applicants_id'];
        $applicant_id = $_POST['applicant_id'];
        $activity_id = $_POST['activity_id'];
        DB::table('applicants')->where('id', '=', $id)->update(['status' => '已通过']);
        $success = DB::table('applicants')->where('id', '=', $id)->first();
        $check = DB::table('activities')->where('id', '=', $activity_id)->first();
        if ($check) {
            $Participants = $check->Participants . ',' . $applicant_id;
            DB::table('activities')->where('id', '=', $activity_id)->increment('num', 1, [
                'Participants' => $Participants
            ]);
            DB::table('rooms')->where('activity_name', '=',  $check->title)->increment('num', 1, [
                'Participants' => $Participants
            ]);
        }
        $data = $success->status;
        return json_encode($data);
    }

    public function apply()
    {
        if ($_POST['content'] != null | $_POST['contact'] != null) {
            $input = array();
            $input['applicant_id'] = Auth::user()->id;
            $input['applicant_name'] = Auth::user()->name;
            $input['activity_id'] = $_POST['activity_id'];
            $input['apply_reason'] = $_POST['content'];
            $input['contact'] = $_POST['contact'];
            $input['create_time'] = Carbon::now();
            $check = Applicant::create($input);
            if (!$check) {
                $data = "请重新输入";
                return json_encode($data);
            } else {
                $data = "发送成功";
                return json_encode($data);
            }
        }else{
            $data="申请内容跟联系方式不能为空";
            return json_encode($data);
        }
    }
}

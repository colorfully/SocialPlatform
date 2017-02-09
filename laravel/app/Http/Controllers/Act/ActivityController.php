<?php

namespace App\Http\Controllers\Act;

use App\Activity;
use App\Chat;
use App\Room;
use EndaEditor;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Activity = Activity::select('activities.*', 'users.head_ico')->join('users', 'activities.name', '=', 'users.name')->orderby('create_time', 'desc')->Paginate(7);
        return view('act.index', [
            'Activity' => $Activity,
        ]);
    }

    public function interest()
    {
        $follow_id = [];
        $love_id = [];
        $name = [];
        $id = DB::table('follows')->where('name', Auth::user()->name)->first();
        $follow = explode(',', $id->follow);
        $love = explode(',', $id->love);
        foreach ($follow as $f) {
            $follow_id[] = $f;
        }
        foreach ($love as $l) {
            $love_id[] = $l;
        }
        $combine_array = array_merge($love_id, $follow_id);
        $remove_repeat = array_unique($combine_array);
        $name_array = DB::table('follows')->select('name')->wherein('id', $remove_repeat)->get();
        foreach ($name_array as $c) {
            $name[] = $c->name;
        }
        $inter_activity = DB::table('activities')->select('activities.*', 'users.head_ico')->join('users', 'users.name', '=', 'activities.name')->wherein('activities.name', $name)->orderby('create_time', 'desc')->Paginate(2);
        return view('act.interest', ['activity' => $inter_activity]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('act.create');
    }

    public function memberDestroy($activity,$id)
    {
        $user=DB::table('activities')->where('id',$activity)->first();
       // $room=DB::table('rooms')->where('activity_name',$user->title)->first();
        $new=preg_replace('/,'.$id.'/',"",$user->Participants);
        $new_num=$user->num-1;
        DB::table('rooms')->where('activity_name', $user->title)->update(['Participants' => $new,'num'=>$new_num]);
        DB::table('activities')->where('id',$activity)->update(['Participants' => $new,'num'=>$new_num]);
        return back();
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
        $this->validate($request,
            [
                'title' => 'required|unique:activities,title',
                'content' => 'required'
            ],
            [
                'title.unique'=>'已经存在该活动名',
                'title.required'=>'活动名不能为空',
                'content.required'=>'内容不能为空'
            ]);
        $input = $request->all();
        $input['create_time'] = Carbon::now();
        $input['content'] = $request->get('content');
        $input['Participants'] = Auth::user()->id;
        preg_match('/http:\/\/localhost:8000\/img\/.*?.jpg|http:\/\/localhost:8000\/img\/.*?.png/', $request->get('content'), $pic);
        if (is_null($pic)){
            $input['cover'] = null;
        }else{
            foreach ($pic as $pics)
                $input['cover'] = $pics;
        }
        Activity::create($input);
        return redirect('/activity');
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
        $activity = Activity::find($id);
        $str = explode(',', $activity->Participants);
            if (in_array(Auth::user()->id,$str))
                $inspection = 1;
            else
                $inspection = null;
        $show = EndaEditor::MarkDecode($activity->content);
        $applicants = DB::table('users')->select('head_ico')->whereIn('id', $str)->get();
        $checkRoom = DB::table('rooms')->where('activity_name', $activity->title)->first();
        return view('act.show', [
            'activity' => $activity,
            'applicants' => $applicants,
            'check' => $inspection,
            'show' => $show,
            'checkRoom' => $checkRoom
        ]);
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
        $activity = Activity::find($id);
        $room = Room::where('activity_name', $activity->title)->first();
        $chat = DB::table('chats')->where('room', $room->title)->delete();
        $room->delete();
        $activity->delete();
        return back();
    }
}

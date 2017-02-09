<?php

namespace App\Http\Controllers\Act;

use App\Chat;
use App\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $new=false;
        $room= [];
        $check=DB::table('rooms')->get();
        foreach ($check as $member){
            $checkMsg=DB::table('chats')->select('status')->where('room',$member->title)->orderby('create_time','desc')->first();
            $str=explode(',',$member->Participants);
            if (in_array(Auth::user()->id,$str)){
                $room[]=$member;
                if($checkMsg==null)
                    continue;
                if (is_numeric($checkMsg->status)){
                        if ($checkMsg->status!=Auth::user()->id){
                                $room[count($room) - 1]->new = true;
                                continue;
                        }
                }else{
                    $cut=explode(',',$checkMsg->status);
                    if (!in_array(Auth::user()->id,$cut)){
                        $room[count($room) - 1]->new = true;
                        continue;
                    }
                }
            }
        }
        return view('act.room',['room'=>$room]);
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

    public function storeChat(){
        $data=null;
        if($_POST['content']!=null){
            $input['name']=Auth::user()->name;
            $input['head_ico']=Auth::user()->head_ico;
            $input['content']=$_POST['content'];
            $input['room']=$_POST['room'];
            $input['status']=Auth::user()->id;
            $input['create_time']=Carbon::now();
            Chat::create($input);
            $data='发送成功';
        }else{
            $data='请输入聊天室名称';
        }
        return json_encode($data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=null;
        if($_POST['content']!=null){
            $input['activity_name']=$_POST['activity_name'];
            $input['title']=$_POST['content'];
            $input['Participants']=$_POST['Participants'];
            $input['num']=$_POST['num'];
            $input['create_time']=Carbon::now();
            Room::create($input);
            $data='创建成功';
        }else{
            $data='请输入聊天室名称';
        }
        return json_encode($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $status="";
        $room=Room::find($id);
        foreach ($room as $user){
            $str=explode(',',$room->Participants);
            $partner=DB::table('users')->select('name','head_ico')->wherein('id',$str)->get();
        }
        $chat=DB::table('chats')->select('chats.*','rooms.Participants')->join('rooms','chats.room','=','rooms.title')->where('room',$room->title)->get();
        foreach ($chat as $member)
        {
            if(is_numeric($member->status)){
                if (Auth::user()->id!=$member->status)
                {
                    $status=$member->status.','.Auth::user()->id;
                    break;
                }
            }else{
                $str=explode(',',$member->status);
                if (in_array(Auth::user()->id,$str)!=true){
                    $status=$member->status.','.Auth::user()->id;
                    break;
                }
            };
        }
        if ($status!=""){
            DB::table('chats')->where('room',$room->title)->update(['status'=>$status]);
        }
        return view('act.chat',[
            'room'=>$room,
            'partner'=>$partner,
            'chat'=>$chat
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

    }
}

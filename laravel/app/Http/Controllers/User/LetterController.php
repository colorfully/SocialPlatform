<?php

namespace App\Http\Controllers\User;

use App\Letter;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
            $private=DB::table('letters')->where('other_id','=',Auth::user()->id)->where('status','=',0)->GROUPBY('name')->get();
            if ($private==null)
            {
                $private=DB::table('letters')->where('other_id','=',Auth::user()->id)->GROUPBY('name')->get();
            }
            return view('author/letter',[
                'private'=>$private
            ]);
    }
    

    public  function ShowLetter(Request $request,$id,$mine_id){
            $private=DB::table('letters')->where(['mine_id'=>$mine_id, 'other_id'=>Auth::user()->id])->orwhere(['mine_id'=>Auth::user()->id, 'other_id'=>$mine_id])->orderby('create_time')->get();
           DB::table('letters')->where('mine_id',$mine_id)->where('other_id',Auth::user()->id)->where('status',0)->update(['status' => 1]);
            return view('author.showchat',[
                'private'=>$private,
                'mine_id'=>$mine_id
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {


    }

    public function  insertLetter(Request $request){
        $input=array();
        $input['mine_id']=Auth::user()->id;
        $input['other_id']=$_POST['other_id'];
        $input['name']=Auth::user()->name;
        $input['head_ico']=Auth::user()->head_ico;
        $input['content']=$_POST['content'];
        $input['create_time']=Carbon::now();
        $check=Letter::create($input);
        if(!$check){
            $data="请重新输入";
            return json_encode($data);
        }else{
            $data="发送成功";
            return json_encode($data);
        }
    }

    public function  replyLetter(Request $request){
        $input=array();
        if ($_POST['content']!=null) {
            $input['mine_id'] = Auth::user()->id;
            $input['other_id'] = $_POST['other_id'];
            $input['name'] = Auth::user()->name;
            $input['head_ico'] = Auth::user()->head_ico;
            $input['content'] = $_POST['content'];
            $input['create_time'] = Carbon::now();
            $check = Letter::create($input);
            if (!$check) {
                $data = "请重新输入";
                return json_encode($data);
            } else {
                $data = "发送成功";
                return json_encode($data);
            }
        }else{
            $data = "内容不能为空";
            return json_encode($data);
        }
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

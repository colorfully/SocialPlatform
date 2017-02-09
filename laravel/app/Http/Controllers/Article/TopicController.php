<?php

namespace App\Http\Controllers\Article;

use App\Article;
use App\Topic;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $topic = DB::table('topics')->select('topics.*', 'users.head_ico')->join('users', 'users.name', '=', 'topics.name')->where('parent_id', '=', '0')->orderby('create_time','desc')->Paginate(5);
        $topic_id=[];
        $topicTips=DB::table('topics')->where(['name'=>Auth::user()->name, 'status'=>0,'parent_id'=>0])->get();
        foreach ($topicTips as $toptip){
            $topic_id[]=$toptip->id;
        }
        $topicTip=DB::table('topics')->wherein('parent_id',$topic_id)->where('status',0)->count();
        return view('topic.index', [
            'topic' => $topic,
            'topicTips'=>$topicTip
        ]);
    }

    public function MyTopic()
    {
       $tips=array();
        $topic=DB::table('topics')->select('topics.*', 'users.head_ico')->join('users', 'users.name', '=', 'topics.name')->where(['parent_id'=>0,'topics.name'=>Auth::user()->name])->orderby('create_time','desc')->get();
        foreach ($topic as $tip){
       $topicTips=DB::table('topics')->where(['parent_id'=>$tip->id, 'status'=>0])->orderby('create_time','desc')->first();
            $tips[]=$tip;
            if ($topicTips==null){
                $tips[count($tips)-1]->tip=false;
                continue;
            }else{
                $tips[count($tips)-1]->tip=true;
                continue;
            }
     }
        return view('topic.myTopic', [
            'topic' => $topic,
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
        return view('topic.create');
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
                'content' => 'required'
            ],[
                'content.required'=>'内容不能为空'
            ]);
        $input = $request->all();
        $input['name'] = Auth::user()->name;
        $input['create_time'] = Carbon::now();
        Topic::create($input);
        return redirect('/');
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
        $result = DB::table('topics')->select('topics.*', 'users.head_ico')->join('users', 'users.name', '=', 'topics.name')->where('topics.id','=',$id)->first();
        $answer =  DB::table('topics')->select('topics.*', 'users.head_ico')->join('users', 'users.name', '=', 'topics.name')->where('parent_id', '=', $id)->orderby('create_time','desc')->Paginate(5);
        if ($result->name==Auth::user()->name){
            DB::table('topics')->where('parent_id', '=', $id)->update(['status'=>1]);
        }
        return view('topic.show', [
            'result' => $result,
            'answer' => $answer
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
        $top = Topic::find($id);
        $other_top=Topic::where('parent_id',$id)->delete();
        $top->delete();
        return back();
    }

    public function answer()
    {
        if ($_POST['content']!=null) {
            $input['content'] = $_POST['content'];
            $input['parent_id'] = $_POST['id'];
            $input['name'] = Auth::user()->name;
            $input['create_time'] = Carbon::now();
            $data = Topic::create($input);
            $data['time'] = date("Y-m-d  h:i:s", strtotime($data->create_time));
            $data['head_ico'] = Auth::user()->head_ico;
        }else{
            $data['error']='内容不能为空';
        }
        return json_encode($data);
    }
}

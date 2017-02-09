<?php

namespace App\Http\Controllers\Comment;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Comment;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function index()
//    {
//        //
//    }

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
    public function store(Request $request)
    {
        //
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
    protected function getCommlist($parent_id = 0,&$result = array()){
        $arr = DB::table('comments')->where('parent_id','=',$parent_id)->orderby('create_time', 'desc')->get();
        if(empty($arr)){
            return array();
        }
        foreach ($arr as $cm) {
            $thisArr=&$result[];
            $cm["children"] = $this->getCommlist($cm["id"],$thisArr);
            $thisArr = $cm;
        }
        return $result;
    }
    public function index(){
        $num = DB::table('comments')->count(); //获取评论总数
        $num1=$num;
        $data=array();
        $data=$this->getCommlist();//获取评论列表
        $commlist=$data;
        return view('articles.show');
    }
    /**
     *添加评论
     */
    public function addComment(){
        $cm=array();
        if((isset($_POST["comment"]))&&(!empty($_POST["comment"]))){
            $cm =$_POST["comment"];//通过第二个参数true，将json字符串转化为键值对数组
            $cm['create_time']=Carbon::now();
            $id = Comment::create($cm);
            $head=DB::table('users')->select('head_ico')->where('name', $id->getAttribute('name'))->first();
            if($id->getAttribute('parent_id')!=0){
                $commented=DB::table('comments')->select('name')->where('id', $id->getAttribute('parent_id'))->first();
                $cm["commented"]=$commented->name;
            }
            $cm["id"] = $id->getAttribute('id');
            $cm["head_ico"]=$head->head_ico;
            $data = $cm;
            $data['create_time']=date("Y-m-d H:i:s",strtotime($id->getAttribute('create_time')));
            $num =  DB::table('comments')->where('article_id',$cm['article_id'])->count();//统计评论总数
            $data['num']= $num;
        }else{
            $data["error"] = "0";
        }
        return json_encode($data);
   }

}

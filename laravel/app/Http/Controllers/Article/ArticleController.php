<?php

namespace App\Http\Controllers\Article;

use App\Activity;
use App\Comment;
use App\Follow;
use App\User;
use Illuminate\Http\Request;
use EndaEditor;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $page = Article::select('articles.*', 'users.head_ico')->join('users', 'articles.author', '=', 'users.name')->Liked()->latest()->Published()->Paginate(7);
        return view('articles.index', [
            'page' => $page,
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
        return view('articles.create');
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
                'title' => 'required|unique:articles,title',
                'content' => 'required',
                'published_at'=>'after:yesterday|required'
            ],
            [
                'title.unique'=>'已经存在该标题',
                'title.required'=>'标题不能为空',
                'content.required'=>'内容不能为空',
                'published_at.after'=>'日期过期',
                'published_at.required'=>'日期不能为空'
            ]);
        $input = $request->all();
        $intro = preg_replace('/(!|)\[.*\](:|)|http:\/\/localhost:8000\/img\/.*?.jpg|\r\n/', '', $request->get('content'));
        $input['intro'] = mb_substr($intro, 0, 110);
       preg_match('/http:\/\/localhost:8000\/img\/.*?.jpg|http:\/\/localhost:8000\/img\/.*?.png/', $request->get('content'), $pic);
        if (is_null($pic)){
            $input['first_pic'] = null;
        }else{
            foreach ($pic as $pics)
            $input['first_pic'] = $pics;
        }
        Article::create($input);
        return redirect('/home');
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
        $article = Article::find($id);
        $article_id = $id;
        $show = EndaEditor::MarkDecode($article->content);
        if (is_numeric($article->like_id))
        {
            if (Auth::user()->id==$article->like_id){
                $like=true;
            }else{
                $like=false;
            }
        }else{
            $check_art_id = explode(',', $article->like_id);
            if (in_array(Auth::user()->id, $check_art_id)) {
                $like=true;
            }else{
                $like=false;
            }
        }
        $comment = DB::table('comments')->select('comments.*', 'users.head_ico')->where(['parent_id' => 0, 'article_id' => $id])->Join('users', 'users.name', '=', 'comments.name')->orderBy('create_time', 'desc')->get();
        $second_reply = DB::table('comments')->select('comments.*', 'users.head_ico')->where(['gra_parent_id' => 0, 'article_id' => $id])->Join('users', 'users.name', '=', 'comments.name')->orderBy('create_time', 'desc')->get();
        $third_reply = DB::table('comments')->select('comments.*', 'users.head_ico')->where('gra_parent_id', '!=', 0)->where('article_id', '=', $id)->Join('users', 'users.name', '=', 'comments.name')->orderBy('create_time', 'desc')->get();
        $comment_num = DB::table('comments')->where('article_id', '=', $id)->count();
        return view('articles.show', [
            'article' => $article,
            'show' => $show,
            'comment' => $comment,
            'comment_num' => $comment_num,
            'reply' => $second_reply,
            'third_reply' => $third_reply,
            'article_id' => $article_id,
            'like'=>$like
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
        $article = Article::find($id);
        return view('articles.edit', compact('article'));
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
        $article = Article::find($id);
        if ($request->get('title')!=$article->title){
            $this->validate($request,
                [
                    'title' => 'unique:articles,title',
                ],
                [
                    'title.unique'=>'已经存在该标题',
                ]);
        }
        $this->validate($request,
            [
                'title' => 'required',
                'content' => 'required',
                'published_at'=>'after:yesterday|required'
            ],
            [
                'title.required'=>'标题不能为空',
                'content.required'=>'内容不能为空',
                'published_at.after'=>'日期过期',
                'published_at.required'=>'日期不能为空'
            ]);
        $intro = preg_replace('/(!|)\[.*\](:|)|http:\/\/localhost:8000\/img\/.*?.jpg|\r\n/', '', $request->get('content'));
        $request['intro']= mb_substr($intro, 0, 130);
        preg_match('/http:\/\/localhost:8000\/img\/.*?.jpg|http:\/\/localhost:8000\/img\/.*?.png/', $request->get('content'), $pic);
        if (is_null($pic)){
            $input['first_pic'] = null;
        }else{
            foreach ($pic as $pics)
                $input['first_pic'] = $pics;
        }
        $article->update($request->all());
        return redirect('/home');
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
        $article = Article::find($id);
        $article->delete();
        return back();
    }

    public function search(Request $request)
    {
        $search = DB::table('articles')->select('articles.*','users.head_ico')->join('users','users.name','=','articles.author')->where('title', 'like', '%' . $request->get('q') . '%')->orWhere('content', 'like', '%' . $request->get('q') . '%')->where('published_at','<=',Carbon::now())->get();
        $search_name = DB::table('users')->select('name', 'head_ico')->where('name', 'like', '%' . $request->get('q') . '%')->get();
        $search_topic=DB::table('topics')->select('topics.*','users.head_ico')->join('users','users.name','=','topics.name')->where('topics.content','like','%'.$request->get('q').'%')->get();
        $search_activity=DB::table('activities')->select('activities.*','users.head_ico')->join('users','users.name','=','activities.name')->where('title', 'like', '%' . $request->get('q') . '%')->get();
        if ($search || $search_name||$search_topic) {
            return view('common.search',['search'=>$search,'search_name'=>$search_name,'search_topic'=>$search_topic,'search_activity'=>$search_activity]);
        } else {
            $search=null;
            $search_name=null;
            $search_topic=null;
            $search_activity=null;
            $nosearch=true;
            return view('common.search',['search'=>$search,'search_name'=>$search_name,'search_topic'=>$search_topic,'search_activity'=>$search_activity,'nosearch'=>$nosearch]);
        }
    }

    //用户个人文章显示列表
    public function ListArticle($username)
    {
        $article=null;
        $activity=null;
        $join=null;
        $apply=null;
        $topic=null;
        $member=null;
        $act=[];
        if ($_GET['page']=='article'){
            $article = DB::table('articles')->where('author', $username)->latest()->get();
        }else if($_GET['page']=='activity'){
            $activity=DB::table('activities')->where('name',$username)->orderby('create_time','desc')->get();
        }else if($_GET['page']=='join'){
            $join=DB::table('activities')->orderby('create_time','desc')->get();
           foreach ($join as $check){
               if (!is_numeric($check->Participants)){
                   $check_id=explode(',',$check->Participants);
                   if(in_array(Auth::user()->id,$check_id)){
                       $act[]=$check;
                   }
               }else{
                   if ($check->Participants==Auth::user()->id){
                       $act[]=$check;
                   }

               }
           }

        }else if($_GET['page']=='apply'){
            $apply=DB::table('applicants')->select('applicants.*','activities.title')->join('activities','applicants.activity_id','=','activities.id')->where('applicant_name',Auth::user()->name)->orderby('create_time','desc')->get();
        }else if($_GET['page']=='topic'){
            $topic=DB::table('topics')->where(['name'=>Auth::user()->name,'parent_id'=>0])->orderby('create_time','desc')->get();
        }else if($_GET['page']=='manger'){
            $activities=DB::table('activities')->select('Participants')->where('id',$_GET['activity'])->first();
            if (!is_numeric($activities->Participants)){
                $id=explode(',',$activities->Participants);
                $member=DB::table('users')->wherein('id',$id)->get();
            }else{
                $member=null;
            }
        }
        return view('articles.lists',['article'=>$article,'activity'=>$activity,'act'=>$act,'apply'=>$apply,'topic'=>$topic,'member'=>$member]);
    }

    public function upload()
    {
        // endaEdit 为你 public 下的目录   @update 2015-05-19 前的版本请更新才能使用
        $data = EndaEditor::uploadImgFile('img');
        return json_encode($data);
    }

    public function like()
    {
        if ((isset($_POST["like"])) && (!empty($_POST["like"]))) {
            $like = $_POST["like"];//通过第二个参数true，将json字符串转化为键值对数组
            $article_id = $_POST['article_id'];
            $author = $_POST['author'];
            if ($author != Auth::user()->name) {
                $id = DB::table('follows')->select('id')->where('name', $author)->first();
                $check = Follow::where('name', Auth::user()->name)->first();
                if ($check->love == "" || $check->love == 'object') {
                    DB::table('follows')->where('name', Auth::user()->name)->update(['love' => $id->id]);
                } else {
                    $check_id = explode(',', $check->love);
                    if (!in_array($id->id, $check_id)) {
                        $love = $check->love . ',' . $id->id;
                        DB::table('follows')->where('name', Auth::user()->name)->update(['love' => $love]);
                    }
                }
                $check_art=DB::table('articles')->where(['author'=>$author,'id'=>$article_id])->first();
                if ($check_art->like_id == "" || $check_art->like_id == 'object') {
                    DB::table('articles')->where(['author'=>$author,'id'=>$article_id])->update(['like_id' => Auth::user()->id]);
                } else {
                    $check_art_id = explode(',', $check_art->like_id);
                    if (!in_array(Auth::user()->id, $check_art_id)) {
                        $love_art = $check_art->like_id . ',' . Auth::user()->id;
                        DB::table('articles')->where(['author'=>$author,'id'=>$article_id])->update(['like_id' => $love_art]);
                    }
                }
            }
            DB::table('articles')->where('id', '=', $article_id)->update(['like' => $like]);
            $num = DB::table('articles')->select('like')->where('id', '=', $article_id)->first();//统计评论总数
            $data = $num;
        } else {
            $data["error"] = "0";
        }

        return json_encode($data);
    }

    public function friend()
    {
        $page = $_GET['page'];
        $follows = DB::table('follows')->where('name', '=', Auth::user()->name)->first();
        $str = explode(',', $follows->follow);
        $friend_art = array();
        $friend = array();
        foreach ($str as $name) {
            $friend[] = DB::table('follows')->select('name')->where('id', '=', $name)->first();
        }
        $friend_names = [];
        foreach ($friend as $f) {
            $friend_names[] = $f->name;
        }
        $friend_art = Article::select('articles.*', 'users.head_ico')->join('users', 'articles.author', '=', 'users.name')->whereIn('author', $friend_names)->skip($page * 10)->take(10)->latest()->get();
        $data = $friend_art;
        return json_encode($data);
    }

    public function NewFriend(){
        $page = $_GET['pages'];
        $loves = DB::table('follows')->where('name', '=', Auth::user()->name)->first();
        if ($loves->follow!=$loves->love){
            $follow_split=explode(',',$loves->follow);
            $love_split=explode(',',$loves->love);
            $c=array_diff($love_split,$follow_split);
        }else{
            $c=null;
        }
        if ($c!=null){
            $user=User::wherein('id',$c)->skip($page * 10)->take(10)->latest()->get();
        }else{
            $user="";
        }
        $data=$user;
        return json_encode($data);
    }

    public function comment()
    {
        $art = DB::table('articles')->select('id')->where('author', Auth::user()->name)->get();
        $a = [];
        //$article=[];
        foreach ($art as $article_id) {
            $a[] = $article_id->id;
        };
        $layout_com=DB::table('comments')->where('name',Auth::user()->name)->get();
        $b=[];
        foreach ($layout_com as $com){
            $b[]=$com->id;
        }
        $comme=DB::table('comments')->select('comments.*', 'users.head_ico', 'articles.title')->join('users', 'comments.name', '=', 'users.name')->Join('articles', 'articles.id', '=', 'comments.article_id')->wherein('parent_id',$b)->where('comments.name', '!=', Auth::user()->name)->where('status', 0)->orderby('create_time', 'desc')->get();
        $NewComments = DB::table('comments')->select('comments.*', 'users.head_ico', 'articles.title')->join('users', 'comments.name', '=', 'users.name')->Join('articles', 'articles.id', '=', 'comments.article_id')->wherein('article_id', $a)->where('parent_id',0)->where('comments.name', '!=', Auth::user()->name)->where('status', 0)->orderby('create_time', 'desc')->get();
        $comments = DB::table('comments')->select('comments.*', 'users.head_ico', 'articles.title')->join('users', 'comments.name', '=', 'users.name')->Join('articles', 'articles.id', '=', 'comments.article_id')->wherein('article_id', $a)->where('comments.name', '!=', Auth::user()->name)->where('status', 1)->orderby('create_time', 'desc')->get();
        $comment = DB::table('comments')->select('comments.*', 'users.head_ico', 'articles.title')->join('users', 'comments.name', '=', 'users.name')->Join('articles', 'articles.id', '=', 'comments.article_id')->wherein('parent_id',$b)->where('comments.name', '!=', Auth::user()->name)->where('status', 1)->orderby('create_time', 'desc')->get();
        DB::table('comments')->wherein('article_id', $a)->where('status', 0)->update(['status' => 1]);
        DB::table('comments')->wherein('parent_id', $b)->where('status', 0)->update(['status' => 1]);
        return view('articles.comment', ['comments' => $comments, 'comment'=>$comment,'NewComments' => $NewComments,'comme'=>$comme]);
    }
}

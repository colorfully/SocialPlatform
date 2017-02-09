<?php

namespace App\Http\Controllers\User;

use App\Follow;
use App\User;
use Illuminate\Http\Request;
use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Encryption\DecryptException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($username)
    {
        //
        $user = User::where('name', $username)->first();
        $article = Article::where('author', $username)->latest()->Paginate(10);
        $article_num = Article::where('author', $username)->count();
        $follow = Follow::where('name', $username)->first();
        //查看粉丝是否为空
        if ($follow->fan == null) {
            $fans = null;
            $fans_num = 0;
        } else {
            $fans = explode(',', $follow->fan);
            $fans_num = count(explode(',', $follow->fan));
        }
        if ($fans != null) {
            foreach ($fans as $fan) {
                if ($fan == Auth::user()->id) {
                    $check = true;
                    break;
                } else {
                    $check = false;
                }
            }
        } else {
            $check = 0;
        }
        //查看跟踪是否为空
        if ($follow->follow == null)
            $follow_num = 0;
        else
            $follow_num = count(explode(',', $follow->follow));
        //他的话题
        $topic_num=DB::table('topics')->where(['name'=>$username,'parent_id'=>0])->count();
        //他的活动
        $activity_num=DB::table('activities')->where('name',$username)->count();
        return view('author.index', [
            'article' => $article,
            'user' => $user,
            'article_num' => $article_num,
            'follow' => $follow,
            'fans' => $fans,
            'check' => $check,
            'fans_num' => $fans_num,
            'follow_num' => $follow_num,
            'topic_num'=>$topic_num,
            'activity_num'=>$activity_num
        ]);
    }

    public function show($username,$category)
    {
        $result=null;
        $user = User::where('name', $username)->first();
        $article_num = Article::where('author', $username)->count();
        $follow = Follow::where('name', $username)->first();
        //查看粉丝是否为空
        if ($follow->fan == null) {
            $fans = null;
            $fans_num = 0;
        } else {
            $fans = explode(',', $follow->fan);
            $fans_num = count(explode(',', $follow->fan));
        }
        if ($fans != null) {
            foreach ($fans as $fan) {
                if ($fan == Auth::user()->id) {
                    $check = true;
                    break;
                } else {
                    $check = false;
                }
            }
        } else {
            $check = 0;
        }
        //查看跟踪是否为空
        if ($follow->follow == null)
            $follow_num = 0;
        else
            $follow_num = count(explode(',', $follow->follow));
        //他的话题
        $topic_num=DB::table('topics')->where(['name'=>$username,'parent_id'=>0])->count();
        //他的活动
        $activity_num=DB::table('activities')->where('name',$username)->count();
        if($category=='topic'){
            $result=DB::table('topics')->select('topics.*','users.head_ico')->join('users','users.name','=','topics.name')->where(['topics.name'=>$username,'parent_id'=>0])->orderby('create_time','desc')->Paginate(10);
        }else if ($category=='activity'){
            $result=DB::table('activities')->select('activities.*','users.head_ico')->join('users','users.name','=','activities.name')->where('activities.name',$username)->orderby('create_time','desc')->Paginate(10);
        }
        return view('author.show', [
            'category'=>$category,
           'result'=>$result,
            'user' => $user,
            'article_num' => $article_num,
            'follow' => $follow,
            'fans' => $fans,
            'check' => $check,
            'fans_num' => $fans_num,
            'follow_num' => $follow_num,
            'topic_num'=>$topic_num,
            'activity_num'=>$activity_num
        ]);
    }

    public function fanlist($username)
    {
        $user = User::where('name', $username)->first();
        $article_num = Article::where('author', $username)->count();
        $follow = Follow::where('name', $username)->first();
        //查看粉丝是否为空
        if ($follow->fan == null) {
            $fans = null;
            $fans_num = 0;
            $fans_info=null;
        } else {
            $fans = explode(',', $follow->fan);
            $fans_num = count(explode(',', $follow->fan));
           foreach ($fans as $fans_id)
           {
               $fans_info[] = DB::table('users')->select('name', 'head_ico')->where('id', $fans_id)->first();
           }
        }
        if ($fans != null) {
            foreach ($fans as $fan) {
                if ($fan == Auth::user()->id) {
                    $check = true;
                    break;
                } else {
                    $check = false;
                }
            }
        } else {
            $check = 0;
        }
        //查看跟踪是否为空
        if ($follow->follow == null){
            $follow_num = 0;
        } else {
            $follow_num = count(explode(',', $follow->follow));
        }
        //他的话题
        $topic_num=DB::table('topics')->where(['name'=>$username,'parent_id'=>0])->count();
        //他的活动
        $activity_num=DB::table('activities')->where('name',$username)->count();
        return view('author.fanlist', [
            'user' => $user,
            'topic_num'=>$topic_num,
            'activity_num'=>$activity_num,
            'article_num' => $article_num,
            'follow' => $follow,
            'check' => $check,
            'fans' => $fans,
            'fans_num' => $fans_num,
            'follow_num' => $follow_num,
            'fans_info'=>$fans_info
        ]);
    }

    public function follow($username)
    {
        $user = User::where('name', $username)->first();
        $article_num = Article::where('author', $username)->count();
        $follow = Follow::where('name', $username)->first();
        //查看粉丝是否为空
        if ($follow->fan == null) {
            $fans = null;
            $fans_num = 0;
            $fans_info=null;
        } else {
            $fans = explode(',', $follow->fan);
            $fans_num = count(explode(',', $follow->fan));
        }
        if ($fans != null) {
            foreach ($fans as $fan) {
                if ($fan == Auth::user()->id) {
                    $check = true;
                    break;
                } else {
                    $check = false;
                }
            }
        } else {
            $check = 0;
        }
        //查看跟踪是否为空
        if ($follow->follow == null)
        {
            $follow_num = 0;
            $follows = null;
            $follows_info=null;
        }
        else {
            $follow_num = count(explode(',', $follow->follow));
            $follows = explode(',', $follow->follow);
            foreach ($follows as $follows_id) {
                $follows_info[]= DB::table('users')->select('name', 'head_ico')->where('id', $follows_id)->first();
            }
        }
        //他的话题
        $topic_num=DB::table('topics')->where(['name'=>$username,'parent_id'=>0])->count();
        //他的活动
        $activity_num=DB::table('activities')->where('name',$username)->count();
        return view('author.followlist', [
            'user' => $user,
            'topic_num'=>$topic_num,
            'activity_num'=>$activity_num,
            'article_num' => $article_num,
            'follow' => $follow,
            'check' => $check,
            'follow_num'=>$follow_num,
            'follows_info' => $follows_info,
            'fans_num' => $fans_num
        ]);
    }

    public function Reset()
    {
        return view('auth.reset');
    }

    public  function RePassword()
    {
        return view('auth.resetpassword');
    }

    public function setReset(Request $request)
    {
        $this->validate($request, ['email' => 'required|exists:users,email'], ['email.required' => '邮箱不能为空', 'email.exists' => '不存在邮箱']);
        $check = DB::table('users')->where('email', $request->get('email'))->first();
        return view('auth.resetpassword')->with('check',$check);
    }


    public function ResetPassword(Request $request)
    {
        $this->validate($request,['password'=>'required|confirmed|min:6'],['password.required'=>'密码不能为空',
        'password.confirmed'=>'两次密码不一样',
        'password.min'=>'密码不能少于6位']);
        $check = DB::table('users')->where(['id'=>$request->get('id'),'question'=>$request->get('question'),'answer'=>$request->get('answer')])->first();
        if ($check!=null)
        {
            DB::table('users')->where('id', $check->id)->update(['password' => bcrypt($request->get('password'))]);
        }else{
            return view('auth.reset');
        }
        return view('auth.login');
    }

    public  function  CheckAnswer()
    {
        $id=$_POST['id'];
        $answer=$_POST['answer'];
        $question=$_POST['question'];
        $check=DB::table('users')->where(['id'=>$id,'question'=>$question])->first();
        if ($answer==$check->answer){
            $data="成功";
            return json_encode($data);
        }else{
            $data="失败";
            return json_encode($data);
        }
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


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $show = User::find($id);
        return view('author.setmsg')->with('show', $show);
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
        $input = User::find($id);
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
}

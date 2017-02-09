<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use EndaEditor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class CommonController extends Controller
{
    public function Manage($category)
    {
        $show_num = null;
        $result = null;
        $count = null;
        if ($category == 'user') {
            $show_num = 5;
            $result = DB::table('users')->orderby('created_at','desc')->Paginate($show_num);
            $count = DB::table('users')->count();
        } elseif ($category == 'articles') {
            $show_num = 10;
            $result = DB::table('articles')->orderby('created_at','desc')->Paginate($show_num);
            $count = DB::table('articles')->count();
        } elseif ($category == 'topics') {
            $show_num = 10;
            $result = DB::table('topics')->where('parent_id', '=', 0)->orderby('create_time','desc')->Paginate($show_num);
            $count = DB::table('topics')->count();
        } else if ($category == 'activity') {
            $show_num = 10;
            $result = DB::table('activities')->orderby('create_time','desc')->Paginate($show_num);
            $count = DB::table('activities')->count();
        }
        return view('admin.manage', [
            'result' => $result,
            'count' => $count,
            'show_num' => $show_num,
            'category' => $category
        ]);
    }

    public function Info($category, $id)
    {
        $count = null;
        $result = null;
        $content = null;
        if ($category == 'user') {
            $result = DB::table('users')->find($id);
        } else if ($category == 'article') {
            $result = DB::table('articles')->find($id);
        } else if ($category == 'comment') {
            $result = DB::table('comments')->where('article_id', '=', $id)->orderby('create_time','desc')->Paginate(5);
        } else if ($category == 'topic') {
            $result = DB::table('topics')->find($id);
            $count = DB::table('topics')->where('parent_id', '=', $id)->orderby('create_time','desc')->count();
        } else if ($category == 'topic_reply') {
            $result = DB::table('topics')->where('parent_id', '=', $id)->Paginate(5);
        } else if ($category == 'activity') {
            $result = DB::table('activities')->find($id);
            $content = EndaEditor::MarkDecode($result->content);
        } else if($category=='chatroom'){
            $activity = DB::table('activities')->find($id);
            $title = DB::table('rooms')->where('activity_name',$activity->title)->first();
            $result=DB::table('chats')->where('room',$title->title)->Paginate(5);
        }
        return view('admin.show', [
            'result' => $result,
            'category' => $category,
            'count' => $count,
            'content' => $content
        ]);

    }

    public function Destroy($category, $id)
    {
        //
        if ($category == 'user') {
            DB::table('users')->delete($id);
        } elseif ($category == 'article') {
            DB::table('articles')->delete($id);
        } elseif ($category == 'comment') {
            DB::table('comments')->delete($id);
        } elseif ($category == 'topic') {
            DB::table('topics')->delete($id);
        } elseif ($category == 'topic_reply') {
            DB::table('topics')->delete($id);
        }elseif ($category == 'chatroom') {
            DB::table('chats')->delete($id);
        }elseif ($category=='activity'){
            $check=DB::table('activities')->find($id);
            $check_room=DB::table('rooms')->where('activity_name',$check->title)->first();
            DB::table('chats')->where('room',$check_room->title)->delete();
            DB::table('rooms')->where('activity_name',$check->title)->delete();
            DB::table('activities')->delete($id);
        }
        return back();
    }
    
    public function Search(){
        $search=$_POST['search'];
        $category=$_POST['category'];
        $result=null;
        if ($category=='user'){
            $result=DB::table('users')->where('name', 'like', '%' . $search . '%')->first();
        }elseif ($category=='articles'){
            $result=DB::table('articles')->where('title', 'like', '%' . $search . '%')->first();
            $result->published_at=date("Y-m-d",strtotime($result->published_at));
        }elseif ($category=='activity'){
            $result=DB::table('activities')->where('title', 'like', '%' . $search . '%')->first();
            if(isset($result)) {
                $result->create_time = date("Y-m-d", strtotime($result->create_time));
            }
        }else if($category=='topics'){
            $result=DB::table('topics')->where('content', 'like', '%' . $search . '%')->first();
            if(isset($result)){
                $result->create_time=date("Y-m-d",strtotime($result->create_time));
            }
        }
        $data=$result;
        if ($data==null){
            $data='没有搜索结果';
        }
        return json_encode($data);
    }
}

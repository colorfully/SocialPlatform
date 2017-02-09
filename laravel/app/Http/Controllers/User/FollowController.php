<?php

namespace App\Http\Controllers\User;

use App\Follow;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FollowController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if((isset($_POST["follow"]))&&(!empty($_POST["follow"]))){
            $follows =$_POST["follow"];//通过第二个参数true，将json字符串转化为键值对数组
            $check=Follow::where('name', '=', $follows['followed_name'])->first();
            $check_follow=DB::table('follows')->where('name', $follows['follow_name'])->first();
            if(isset($check)){
                //被跟踪人的粉丝更新
               if($check['fan']==""){
                   $fans=$follows['follow_id'];
               }else{
                   $fans=$check['fan'].','.$follows['follow_id'];
               }
                DB::table('follows')->where('id', $check['id'])->update(['fan' => $fans]);
                //跟踪者的粉丝更新
                if($check_follow->follow==""){
                    $my_follows=$follows['followed_id'];
                }else{
                    $my_follows=$check_follow->follow.','.$follows['followed_id'];
                }
                DB::table('follows')->where('name', $follows['follow_name'])->update(['follow' => $my_follows]);
            }else{
                Follow::updateOrCreate(array('name' => $follows['followed_name']), array('fan' => $follows['follow_id']));
            }
            $data='ok';
        }else{
            $data["error"] = "0";
        }
        return json_encode($data);
    }

    public function UnFollow()
    {
        if((isset($_POST["unfollow"]))&&(!empty($_POST["unfollow"]))){
            $unfollows =$_POST["unfollow"];//通过第二个参数true，将json字符串转化为键值对数组
            $check=Follow::where('name', '=', $unfollows['followed_name'])->first();
            $check_follow=Follow::where('name',$unfollows['follow_name'])->first();
            if(isset($check)){
                $fans=preg_replace('/,*'.$unfollows['follow_id'].',*/', '',$check['fan']);
               DB::table('follows')->where('id', $check['id'])->update(['fan' => $fans]);
                $follow=preg_replace('/,*'.$unfollows['followed_id'].',*/', '', $check_follow['follow']);
                DB::table('follows')->where('id', $check_follow['id'])->update(['follow' =>  $follow]);
            }else{
    //            Follow::updateOrCreate(array('name' => $follows['followed_name']), array('fan' => $follows['follow_id']));
            }
            $data='ok';
        }else{
            $data["error"] = "0";
        }
        return json_encode($data);
    }
}

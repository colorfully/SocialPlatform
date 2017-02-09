<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        view()->composer('layouts/app', function ($view) {
//            私信提示
            $letter=DB::table('letters')->where('other_id',Auth::user()->id)->where('status',0)->count();
//             聊天室提示
            $chatRoom=null;
            $chat=DB::table('chats')->select('chats.*','rooms.Participants')->join('rooms','chats.room','=','rooms.title')->get();
            if ($chat!=null){
            foreach ($chat as $member){
                $str=explode(',',$member->Participants);
                $check=explode(',',$member->status);
                if (in_array(Auth::user()->id,$str)&&!in_array(Auth::user()->id,$check)){
                    $chatRoom=true;
                    continue;
                }else{
                    $chatRoom=false;
                    continue;
                }
            }
            }
//            随机文章
            $randArticle = DB::select('select * from articles  where date_sub(curdate(), INTERVAL 30 DAY) <= date(published_at) ORDER BY rand() LIMIT 2');
//            提问提示
            $topic_id=[];
            $topicTips=DB::table('topics')->where(['name'=>Auth::user()->name, 'status'=>0,'parent_id'=>0])->get();
            foreach ($topicTips as $toptip){
                $topic_id[]=$toptip->id;
            }
            $topicTip=DB::table('topics')->wherein('parent_id',$topic_id)->where('status',0)->count();
//            申请提示
            $layout_apply=DB::table('applicants')->select('applicants.status','activities.name')->join('activities','applicants.activity_id','=','activities.id')->where(['name'=>Auth::user()->name,'status'=>'申请中'])->count();
//            评论提示
            $layout_article=DB::table('articles')->select('id')->where('author',Auth::user()->name)->get();
            $a=[];
            foreach($layout_article as $article_id){
                $a[]=$article_id->id;
            };
            $layout_comm=DB::table('comments')->wherein('article_id',$a)->where('status',0)->where('parent_id',0)->count();
            //二级评论提示
            $layout_com=DB::table('comments')->where('name',Auth::user()->name)->get();
            $b=[];
            foreach ($layout_com as $com){
                $b[]=$com->id;
            }
            $layout_comment=DB::table('comments')->wherein('parent_id',$b)->where('status',0)->where('gra_parent_id','=',0)->count();
            //三级评论提示
            $three_comment=DB::table('comments')->wherein('parent_id',$b)->where('status',0)->where('gra_parent_id','!=',0)->count();
            $layout_comments= $layout_comm+$layout_comment+$three_comment;
            $view->with('letter',$letter)->with('chatRoom',$chatRoom)->with('randArticle', $randArticle)->with('topicTips', $topicTip)->with('layout_apply',$layout_apply)->with('layout_comments',$layout_comments);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

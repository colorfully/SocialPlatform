@extends('layouts.app')
@section('content')
    <div class="page-header" contenteditable="true">
        <h2><strong>{{$article->title}}</strong></h2>
    </div>
    <div class="page-body">
        <p>{!! $show !!}</p>
    </div>
    @if($like==true||Auth::user()->name==$article->author)
        <div class="page-footer" style="margin-top: 10px">
            <i class="fa fa-heart fa-2x" style="float: left;color:red"></i><span
           style="font-size: 21px">{{$article->like}}</span>
        </div>
    @else
        <div class="page-footer" style="margin-top: 10px">
            <span class="like-filed"><i class="fa fa-heart-o fa-2x" style="float: left"></i><span
                        class="like" style="font-size: 21px">{{$article->like}}</span></span>
        </div>
        @endif
                <!-- JiaThis Button BEGIN -->
        <div class="jiathis_style_24x24" style="float: right;margin-top: 10px">
            <a class="jiathis_button_qzone"></a>
            <a class="jiathis_button_tsina"></a>
            <a class="jiathis_button_tqq"></a>
            <a class="jiathis_button_weixin"></a>
            <a class="jiathis_button_renren"></a>
            {{--<a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>--}}
            <a class="jiathis_counter_style"></a>
        </div>
        {{--<script type="text/javascript" src="http://v3.jiathis.com/code_mini/jia.js" charset="utf-8"></script>--}}
        <!-- JiaThis Button END -->
        <div class="page-header" style="margin-top: 20px">
            <h4>评论</h4>
        </div>
        <div class="comment-filed">
            <!--发表评论区begin-->
            <div>
                <div class="comment-num">
                    <span>{{$comment_num}}条评论</span>

                </div>
                <div>
                    <div>
                        <textarea class="txt-commit" rows="4"
                                  style="width:100%;overflow:auto;word-break:break-all; overflow-y:scroll; "></textarea>
                    </div>

                    <div class="div-txt-submit">

                        <a class="comment-submit" parent_id="0" style="" href="javascript:void(0);"><span
                                    style=''>发表评论</span></a>
                    </div>
                </div>
            </div>

            <!--发表评论区end-->

            <!--评论列表显示区begin-->
            <!-- {$commentlist} -->
            <div class="comment-filed-list">
                <div><span class="addcoment">全部评论</span></div>
                <div class="comment-list">
                    <!--一级评论列表begin-->
                    @foreach($comment as $comment)
                        <ul class="comment-ul">
                            <volist name="commlist" id="data">
                                <li comment_id="{{$comment->id}}">
                                    <div>
                                        <div>
                                            <img class="head_ico_index" src="{{$comment->head_ico}}" alt="">
                                        </div>
                                        <div class="cm">
                                            <div class="cm-header">
                                                <span class="cm-name">{{$comment->name}}</span>
                                                <span class="cm-time">时间:{{$comment->create_time}}</span>
                                            </div>
                                            <div class="cm-content">
                                                <p>
                                                    {{$comment->content}}
                                                </p>
                                            </div>
                                            <div class="cm-footer">
                                                <a class="comment-reply" comment_id="{{$comment->id}}"
                                                   href="javascript:void(0);">回复</a>
                                            </div>
                                        </div>
                                        <ul class="children">
                                            <volist name="data.children" id="child">
                                        <!--二级评论begin-->
                                        @foreach($reply as $r)
                                            @if($r->parent_id==$comment->id)
                                                        <li comment_id="{{$r->id}}">
                                                            <div>
                                                                <div>
                                                                    <img class="head_ico_index"
                                                                         src="{{$r->head_ico}}" alt="">
                                                                </div>
                                                                <div class="children-cm">
                                                                    <div class="cm-header">
                                                                            <span class="cm-name">{{$r->name}}
                                                                                <span>回复:</span>{{$comment->name }}</span>
                                                                        <span class="cm-time">{{$r->create_time}}</span>
                                                                    </div>
                                                                    <div class="cm-content">
                                                                        <p>
                                                                            {{$r->content}}
                                                                        </p>
                                                                    </div>
                                                                    <div class="cm-footer">
                                                                        <a class="comment-reply"
                                                                           comment_id="{{$r->id}}"
                                                                           gra_parent_id="{{$comment->id}}"
                                                                           href="javascript:void(0);">回复</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                            @endif
                                        @endforeach
                                                @foreach($third_reply as $re)
                                                    @if($re->gra_parent_id==$comment->id)
                                                        <li comment_id="{{$re->id}}">
                                                            <div>
                                                                <div>
                                                                    <img class="head_ico_index"
                                                                         src="{{$re->head_ico}}" alt="">
                                                                </div>
                                                                <div class="children-cm">
                                                                    <div class="cm-header">
                                                                            <span class="cm-name">{{$re->name}}
                                                                                <span>回复:</span>{{$r->name }}</span>
                                                                        <span class="cm-time">{{$re->create_time}}</span>
                                                                    </div>
                                                                    <div class="cm-content">
                                                                        <p>
                                                                            {{$re->content}}
                                                                        </p>
                                                                    </div>
                                                                    <div class="cm-footer">
                                                                        <a class="comment-reply"
                                                                           comment_id="{{$re->id}}"
                                                                           gra_parent_id="{{$r->id}}"
                                                                           href="javascript:void(0);">回复</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </volist>
                                        </ul>
                                    </div>
                                    <!--二级评论end-->

                                </li>
                            </volist>
                        </ul>
                        <!--一级评论列表end-->
                    @endforeach
                </div>
                <!--评论列表显示区end-->
            </div>
        </div>
        <script type="application/javascript">
            $(document).delegate('.comment-submit', 'click', function () {
                var content = $.trim($(this).parent().prev().children("textarea").val());//根据布局结构获取当前评论内容
                $(this).parent().prev().children("textarea").val("");//获取完内容后清空输入框
                if ("" == content) {
                    alert("评论内容不能为空!");
                } else {
                    var cmdata = new Object();
                    cmdata.parent_id = $(this).attr("parent_id");//上级评论id
                    cmdata.content = content;
                    cmdata.name = '{{Auth::user()->name}}';//测试用数据
                    cmdata.article_id = '{{$article_id}}';
                    cmdata.gra_parent_id = $(this).attr("gra_parent_id");
                    // cmdata.article_id=
                    // var replyswitch = $(this).attr("replyswitch");//获取回复开关锁属性
                    $.ajax({
                        type: "POST",
                        url: "/addComment",
                        data: {
                            _token: '{{csrf_token()}}',//防CSRF攻击
                            comment: cmdata
                        },
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                        if(typeof(data.error)=="undefined"){
                            $(".comment-reply").next().remove();//删除已存在的所有回复div
                            //更新评论总数
                            $(".comment-num").children("span").html(data.num+"条评论");
                            //显示新增评论
                            var newli = "";
                            if(data.parent_id == "0"){
                                //发表的是一级评论时，添加到一级ul列表中
                                newli =$('<ul class="comment-ul"> <volist name="commlist" id="data"><li comment_id="'+data.id+'"><div><div> <img class="head_ico_index" src="'+data.head_ico+'" alt=""> </div> <div class="cm"> <div class="cm-header"> <span class="cm-name">'+data.name+'</span> <span class="cm-time">时间:'+data.create_time+'</span> </div> <div class="cm-content"> <p>'+data.content+' </p> </div> <div class="cm-footer"> <a class="comment-reply" comment_id="'+data.id+'" href="javascript:void(0);">回复</a> </div> </div><!--二级评论begin--> </div><!--二级评论end--> </li>');
                                $(".comment-list").prepend(newli);
                            }else if(data.parent_id !="0"&&data.gra_parent_id =="undefined"){
                                   var items = $('<div> <div> <img class="head_ico_index" src="'+data.head_ico+'" alt=""> </div> <div class="children-cm"> <div class="cm-header"> <span class="cm-name">'+data.name+' <span>回复:</span>'+data.commented+'</span> <span class="cm-time">'+data.create_time+'</span> </div> <div class="cm-content"> <p>'+data.content+'</p> </div> <div class="cm-footer"> <a class="comment-reply" comment_id="'+data.id+'" gra_parent_id="'+data.parent_id+'" href="javascript:void(0);">回复</a></div></div></div>');
                                $("li[comment_id='"+data.parent_id+"']").find("volist").prepend(items);
                            }else if(data.gra_parent_id !="0"){
                                var itemss = $('<div> <div> <img class="head_ico_index" src="'+data.head_ico+'" alt=""> </div> <div class="children-cm"> <div class="cm-header"> <span class="cm-name">'+data.name+' <span>回复:</span>'+data.commented+'</span> <span class="cm-time">'+data.create_time+'</span> </div> <div class="cm-content"> <p>'+data.content+'</p> </div> <div class="cm-footer"> <a class="comment-reply" comment_id="'+data.id+'" gra_parent_id="'+data.parent_id+'" href="javascript:void(0);">回复</a></div></div></div>');
                                $("li[comment_id='"+data.gra_parent_id+"']").find("volist").prepend(itemss);
                            }
                        }else{
                            //有错误信息
                            alert(data.error);
                        }

                        }
                    });
                }
            });
            $(function () {
                $('.like-filed').on('click', function () {
                    $num = Number($('.like').text()) + 1;
                    $id = '{{$article->id}}';
                    $author='{{$article->author}}';
                    $.ajax({
                        type: "POST",
                        url: "/like",
                        data: {
                            _token: '{{csrf_token()}}',//防CSRF攻击
                            article_id: $id,
                            like: $num,
                            author: $author
                        },
                        dataType: "json",
                        success: function (data) {
                            $('.like').text(data.like);
                            $('.fa.fa-heart-o').toggleClass("fa-heart-o fa-heart");
                            $('.fa-heart').css({color:'red'});
                            $('.like-filed').off('click');
                        }
                    });
                })
            })
        </script>
@endsection

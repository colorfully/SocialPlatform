<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Redirect, Response;


class UploadController extends Controller
{
    //Ajax上传图片
    public function imgUpload(Request $request)
    {
       if($request->action=='update_msg'){
           if($request->name!=Auth::user()->name){
           $this->validate($request,
               [
                   'name' => 'required|unique:users,name',
               ],
               [
                   'name.required'=>'用户名不能为空',
                   'name.unique'=>'已存在这个用户名'
               ]);
           }
           DB::table('articles')->where('author', Auth::user()->name)->update([
               'author'=>$request->name
           ]);
           DB::table('comments')->where('name', Auth::user()->name)->update([
               'name'=>$request->name
           ]);
           DB::table('follows')->where('id', Auth::user()->id)->update([
               'name'=>$request->name
           ]);
           DB::table('users')->where('id', Auth::user()->id)->update([
               'name'=>$request->name,
               'intro'=>$request->intro
          ]);
       }else if($request->action=='update_head_ico'){
           if(Auth::user()->id) {
               $file = Input::file('pic');
               // 文件是否上传成功
               if ($file->isValid()) {
                   // 获取文件相关信息
                   $originalName = $file->getClientOriginalName(); // 文件原名
                   $ext = $file->getClientOriginalExtension();     // 扩展名
                   $realPath = $file->getRealPath();   //临时文件的绝对路径
                   $type = $file->getClientMimeType();     // image/jpeg
                   // 上传文件
                   $filename = uniqid() . '.' . $ext;
                   // 使用我们新建的uploads本地存储空间（目录）
                   $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
               }
               DB::table('users')->where('id', Auth::user()->id)->update(['head_ico' => 'http://localhost:8000/uploads/'.$filename]);
           }
       }else{
           echo '错误操作';
       }
        return back();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
}

<?php
use App\Task;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/index', function () {
    return view('index');
});
Route::get('/', 'Auth\AuthController@getLogin');

Route::group(['middleware' => 'auth'], function () {
    //前台路由
    Route::get('/articles/create', 'Article\ArticleController@create');
    Route::post('/articles/store', 'Article\ArticleController@store');
    Route::get('/articles/{id}', 'Article\ArticleController@show');
    Route::get('/articles/{id}/edit', 'Article\ArticleController@edit');
    Route::post('/articles/{id}/update', 'Article\ArticleController@update');
    Route::get('/articles', 'Article\ArticleController@search');
    Route::get('/home', 'Article\ArticleController@index');
    Route::post('/articles/upload', 'Article\ArticleController@upload');
    Route::get('/comment', 'Article\ArticleController@comment');

    //活动
    Route::get('/activity/create', 'Act\ActivityController@create');
    Route::post('/activity/store', 'Act\ActivityController@store');
    Route::get('/activity/', 'Act\ActivityController@index');
    Route::get('/activity/interest', 'Act\ActivityController@interest');
    Route::get('/activity/{id}', 'Act\ActivityController@show');
    Route::get('/activity/{id}/delete', 'Act\ActivityController@destroy');
    Route::get('/activity/delete/{activity}/{id}', 'Act\ActivityController@memberDestroy');
    Route::post('/apply', 'Act\ApplicantController@apply');
    Route::get('/applyList', 'Act\ApplicantController@index');
    Route::post('/applyPass', 'Act\ApplicantController@pass');
    Route::post('/applyRefuse', 'Act\ApplicantController@refuse');
    Route::post('/create/room', 'Act\ChatRoomController@store');
    Route::get('/chatRoom', 'Act\ChatRoomController@index');
    Route::post('/create/chat', 'Act\ChatRoomController@storeChat');
    Route::get('/chatRoom/{id}', 'Act\ChatRoomController@show');


    //个人博客路由
    Route::get('/author/{user}', 'User\UserController@index');
    Route::get('/author/{user}/list', 'Article\ArticleController@ListArticle');
    Route::get('/author/{id}/delete', 'Article\ArticleController@destroy');
    Route::get('/author/{user}/fanlist', 'User\UserController@fanlist');
    Route::get('/author/{user}/follow', 'User\UserController@follow');
    Route::get('/author/{user}/show/{category}', 'User\UserController@show');
    Route::post('/upload_img', 'User\UploadController@imgUpload');
    Route::get('/author/update/{id}', 'User\UserController@edit');
    Route::post('/author/update/{id}', 'User\UploadController@imgUpload');
    Route::get('/letter', 'User\LetterController@index');
    Route::get('/letter/show={id}other={mine_id}', 'User\LetterController@ShowLetter');

    //话题路由
    Route::get('/topic/create', 'Article\TopicController@create');
    Route::post('/topic/create', 'Article\TopicController@store');
    Route::get('/topic', 'Article\TopicController@index');
    Route::get('/topic/MyTopic', 'Article\TopicController@MyTopic');
    Route::get('/topic/{id}', 'Article\TopicController@show');
    Route::get('/topic/{id}/delete', 'Article\TopicController@destroy');
    Route::post('/topic/answer', 'Article\TopicController@answer');

});
//后台路由
Route::any('admin/login', 'Admin\LoginController@login');
Route::get('admin/index', 'Admin\LoginController@index');
Route::get('admin/{category}', 'Admin\CommonController@Manage');
Route::get('admin/info/{category}/{id}', 'Admin\CommonController@Info');
Route::get('admin/Destroy/{category}/{id}', 'Admin\CommonController@Destroy');
Route::post('/admin/search', 'Admin\CommonController@Search');

//ajax路由
Route::any('/addComment', 'Comment\CommentController@addComment');
Route::any('/like', 'Article\ArticleController@like');
Route::any('/follow', 'User\FollowController@index');
Route::any('/unfollow', 'User\FollowController@UnFollow');
Route::any('/FriendsCircle', 'Article\ArticleController@friend');
Route::any('/NewFriends', 'Article\ArticleController@NewFriend');
Route::post('/letter', 'User\LetterController@insertLetter');
Route::post('/replyLetter', 'User\LetterController@replyLetter');
Route::any('/ChangStatus', 'User\LetterController@ChangStatus');


// 认证路由...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// 注册路由...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// 密码重置的路由...
Route::get('password/reset', 'User\UserController@Reset');
Route::post('password/reset', 'User\UserController@setReset');
Route::post('pass/resetpassword', 'User\UserController@ResetPassword');
Route::get('pass/resetpassword', 'User\UserController@RePassword');
Route::post('/checkanswer', 'User\UserController@CheckAnswer');





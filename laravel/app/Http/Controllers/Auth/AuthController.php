<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    public $redirectTo = '/home';
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|unique:users,name',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'question'=>'required',
            'answer'=>'required'
        ],[
            'email.required'=>'邮箱不能为空',
            'question.required'=>'问题不能为空',
            'answer.required'=>'答案不能为空',
            'name.unique'=>'已存在这个用户名',
            'email.unique'=>'已存在邮箱',
            'password.required'=>'密码不能为空',
            'password.confirmed'=>'两次密码不一样',
            'password.min'=>'密码不能少于6位'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        DB::table('follows')->insert(['name'=>$data['name']]);
        return User::create([
            'head_ico'=>'http://localhost:8000/user1.png',
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'question' =>$data['question'],
            'answer' =>$data['answer']
        ]);
    }
}

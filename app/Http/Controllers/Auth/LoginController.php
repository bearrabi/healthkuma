<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //バリデーション
    protected function validateLogin(Request $request){
        
        $messages = [
            $this->username().'.required' => 'Nameを入力してください',
            $this->username().'.alpha_num' => 'Nameは英数字で入力してください',
            'password.required' => 'パスワードを入力してください',
        ];

        $request->validate([
            $this->username() => 'required|alpha_num',
            'password' => 'required|string',
        ], $messages);
    }

    //ログインで必要なユーザー名を指定
    public function username(){ return 'name'; }

    //ログアウト後の移行先を変更
    public function loggedOut(Request $request){    return redirect('/');   }
}

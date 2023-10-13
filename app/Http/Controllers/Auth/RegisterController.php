<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/added';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'username' => 'required|string|max:255',
            'mail' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // テーブル名「users」を単数形にしたものがModelクラス名「User」で連携
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }


    // public function registerForm(){
    //     return view("auth.register");
    // }

    // 新規登録時のバリデーション
    public function register(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();

            Validator::make($data,
            [
                'username' => ['required','between:4,12'],
                'mail' => ['required', 'email','between:4,12','unique:users'],
                'password' => ['required', 'between:4,12','alpha_num'],
                'password-confirm' => ['required', 'alpha_num','between:4,12','same:password'],
                ],

            [
                'username.required' => '入力必須',
                'username.between' => 'username4〜12文字以上で入力してください',
                'mail.required' => '入力必須',
                'mail.unique' => '登録済みアドレス使用不可',
                'mail.between' => 'mail4〜12文字以上で入力してください',
                'password.required' => '入力必須',
                'password.alpha_num' => '英数字のみ',
                'password.between' => 'password4〜12文字以上で入力してください',
                'password-confirm.required' => '入力必須',
                'password-confirm.alpha_num' => '英数字のみ',
                'password-confirm.between' => 'password-confirm4〜12文字以上で入力してください',
                'password-confirm.same' => 'Password入力と一致必須',
            ]
        )->validate();


            $this->create($data);
            session(['key' => $data['username']]);
            return redirect('added');
        }
        return view('auth.register');
    }

    public function added(){
        $data = session('key');

        return view('auth.added',compact('data'));
    }
}

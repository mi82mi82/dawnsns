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
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }


    // public function registerForm(){
    //     return view("auth.register");
    // }

    public function register(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();

            Validator::make($data,
            [
                'UserName' => ['required', 'UserName','between:4,12'],
                'MailAdress' => ['required', 'MailAdress','between:4,12','required|unique:categories,MailAdress'],
                'Password' => ['required', 'between:4,12','alpha_num','categoriesPassword'],
                'Password confirm' => ['required', 'alpha_num','between:4,12','unique:categoriesPassword',':password'],
                ],

            [
                'UserName.required' => '入力必須',
                'UserName.between:4,12' => '4〜12文字以上で入力してください',
                'MailAdress.required' => '入力必須',
                'MailAdress.required|unique:categories,MailAdress' => '登録済みアドレス使用不可',
                'MailAdress.between:4,12' => '4〜12文字以上で入力してください',
                'Password.required' => '入力必修',
                'Password.alpha_num' => '英数字のみ',
                'Password.between:4,12' => '4〜12文字以上で入力してください',
                'Password.required|unique:categoriesPassword' => '登録済みPass使用不可',
                'Password confirm.required' => '入力必須',
                'Password confirm.alpha_num' => '英数字のみ',
                'Password confirm.between:4,12' => '4〜12文字以上で入力してください',
                'Password.confirm.required|unique:categoriesPassword' => '登録済みPass使用不可',
                'Password confirm.same' => 'Password入力と一致必修',
            ]
        );


            $this->create($data);
            return redirect('added');
        }
        return view('auth.register');
    }

    public function added(){
        return view('auth.added');
    }
}

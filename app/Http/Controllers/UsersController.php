<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    //ログインユーザーのプロフィール画面
    public function profile(){
        $user=auth()->user();
        $userimage=auth()->user()->images;
        // dd($getUsers);
        return view('users.profile',compact('user','userimage'));
    }
    
    // ユーザー検索機能
    public function search(Request $request){
        $user=auth()->user();
        if($request->search){
            $getUsers= DB::table('users')
                ->where('username', 'like', "%$request->search%")
                ->get();
        } else {
            $getUsers= DB::table('users')->get();
        }
        // ユーザー検索のフォローするフォロー外す機能
        $followings= DB::table('follows')
            ->where('follower',Auth::id())
            ->pluck('follow');
        // dd($User);
        return view('users.search',compact('user','getUsers','followings'));
    }

    //ログインユーザーだけが使える
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ログインユーザーのプロフィール内容更新
    public function upload(Request $request)
    {
        // プロフィール内容更新のバリデーション
        Validator::make($request->all(),
            [
                'Username' => ['required','between:4,12'],
                'mail' => ['required', 'email','between:4,50',Rule::unique('users')->ignore(Auth::id(), 'id')],
                'newPassword' => ['nullable', 'alpha_num','between:4,12'],
                'bio' => ['nullable','max:200'],
                'image' => ['nullable', 'image'],
            ],

            [
                'Username.required' => '入力必須',
                'Username.between' => '4〜12文字以上で入力してください',
                'mail.required' => '入力必須',
                'mail.unique' => '登録済みアドレス使用不可',
                'mail.between' => '4〜50文字以上で入力してください',
                'newPassword.alpha_num' => '英数字のみ',
                'newPassword.between' => '4〜12文字以上で入力してください',
                'bio' => '200文字以内で入力してください',
                'image' => 'ファイル名が英数字のみ','画像(jpg,png,bmp,gif,svg)ファイル以外は不可'
            ]
        )->validate();
        $update = [];
        $update['username'] = $request->Username;
        $update['mail'] = $request->mail;
        if($request->newPassword){
            $update['password'] = bcrypt($request->newPassword);
        }
        $update['bio'] = $request->bio;
        $update['updated_at'] = now();
        if($request->image){
        // アップロードされたファイル名を取得
        $file_name = $request->file('image')->getClientOriginalName();
        $update['images'] = $file_name;
        // 取得したファイル名で保存
        $request->file('image')->storeAs('images', $file_name, 'public');
        }
        // ファイル情報をDBに保存
        DB::table('users')
            ->where('id',Auth::id())
            ->update($update);
        
        return redirect('/profile');

    }

    // フォローやフォロワーリストからユーザーのプロフィールに飛ぶ
    public function userProfile($userId, Post $post)
    {
        $user=auth()->user();
        $timelines = $post->getFollowTimelines($userId);
        $profile = DB::table('users')
            ->where('id', $userId)
            ->select('id','username','images','bio')
            ->first();
        $followings= DB::table('follows')
            ->where('follower',Auth::id())
            ->pluck('follow');

        return view('users.usersProfile',['timelines' => $timelines, 'user'=>$user,'profile'=>$profile,'followings'=>$followings]);
    }

    // プロフィールの編集バリデーション
    public function profileupdate(Request $request){
        

        return redirect('/profile');
    }
}

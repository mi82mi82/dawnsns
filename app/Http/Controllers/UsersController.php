<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Post;

class UsersController extends Controller
{
    //
    public function profile(){
        $user=auth()->user();
        $userimage=auth()->user()->images;
        // dd($getUsers);
        return view('users.profile',compact('user','userimage'));
    }

    public function search(Request $request){
        $user=auth()->user();
        if($request->search){
            $getUsers= DB::table('users')
                ->where('username', 'like', "%$request->search%")
                ->get();
        } else {
            $getUsers= DB::table('users')->get();
        }
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

    // ログインユーザーのプロフィール画像
    public function upload(Request $request)
    {
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

    public function userProfile($userId, Post $post)
    {
        $user = auth()->user();
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
}

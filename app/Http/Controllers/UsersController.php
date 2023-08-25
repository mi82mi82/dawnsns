<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //
    public function profile(){
        $user=auth()->user();
        $userimage=auth()->user()->images;
        // dd($getUsers);
        return view('users.profile',compact('user','userimage'));
    }

    public function search(){
        $user=auth()->user();
        $getUsers= DB::table('users')->get();
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
        // ディレクトリ名
        $dir = 'sample';

        // usersテーブルのimagesカラムに画像を保存
        $request->file('image')->DB::table('users');

        // アップロードされたファイル名を取得
        $file_name = $request->file('image')->getClientOriginalName();


        // 取得したファイル名で保存
        $request->file('image');

        // ファイル情報をDBに保存
        $image = new Image();
        $image->name = $file_name;
        $image->path = 'storage/' . $dir . '/upload' . $file_name;
        $image->save();

        // dd($request->file('image'));
        return redirect('/upload');

    }
}

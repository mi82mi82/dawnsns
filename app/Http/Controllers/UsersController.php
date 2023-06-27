<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile');
    }
    public function search(){
        return view('users.search');
    }

    //ログインユーザーだけが使える
    public function __construct()
    {
        $this->middleware('auth');
    }

    // 削除する
    // public function delete(Request $request)
    // {
    //     dd($request->id);
        
    //     $posts = DB::table('posts')
    //     ->where('id',$request->id)
    //     ->delete();

    //     return redirect('/top');
    //     // return back();
    // }
}

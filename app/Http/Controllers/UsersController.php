<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile');
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
}

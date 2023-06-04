<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    //
    public function index(){
        $user = auth()->user();
        return view('posts.index',compact('user'));
    }

    // ログインユーザーのみが使えるようにする
    public function __construct()
    {
        $this->middleware('auth');
    }

}

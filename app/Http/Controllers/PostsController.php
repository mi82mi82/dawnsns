<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    //
    public function index(){
        $user = auth()->user();
        $posts = DB::table('posts')
        ->join('users','posts.user_id','=','users.id')
        ->where('users.id',Auth::id())
        ->select('users.images','users.username','posts.id','posts.posts','posts.created_at as created_at')
        ->get();
        return view('posts.index',compact('user','posts'));
    }

    // ログインユーザーのみが使えるようにする
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createForm()
    {
        return view('posts.createForm');
    }

}

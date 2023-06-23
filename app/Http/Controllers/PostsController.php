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

    public function create(Request $request)
    {
        $post = $request->input('newPost');
        // dd($post);にはhelloが入ってた
        DB::table('posts')->insert([
            'posts' => $post,
            'user_id' => Auth::id(),
            'created_at' => now(),
        ]);
 
        return redirect('/top');
    }

    // public function updateForm($id)
    // {
    //     $post = DB::table('posts')
    //         ->where('id', $id)
    //         ->first();
    //     return view( ['posts' => $post]);
    // }

    public function update(Request $request)
    {
        $request -> validate([
            'upPost' => 'required|max:150',
        ]);

        $posts = DB::table('posts')
        ->where('id',$request->id)
        ->update([
            'posts' => $request->upPost,
            'updated_at'=> now(),
        ]);

        return back();
    }

    // $id = $request->input('id');
    // $up_post = $request->input('upPost');
    // DB::table('posts')
    //     ->where('user_id', $id)
    //     ->update(
    //         ['posts' => $up_post]
    //     );

    // return redirect('/top');


    public function delete($id)
    {
        DB::table('posts')
            ->where('id', $id)
            ->delete();
 
        return redirect('/top');
    }
}

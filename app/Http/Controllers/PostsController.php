<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    //Topページを表示する
    public function index(){
        $user = auth()->user();
     // postsテーブルのuser_idがddの結果で表示されるようにdd($posts);で確認
        $posts = DB::table('posts')
        ->join('users','posts.user_id','=','users.id')
        ->where('users.id',Auth::id())
        ->select('users.images','users.username','posts.id','posts.posts','posts.created_at as created_at','posts.user_id')
        ->orderBy('created_at', 'desc') 
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

    // 新規投稿する
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

    // 投稿編集
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


     // 投稿削除する
    public function delete(Request $request)
    {
        //  dd($request->id);

        $posts = DB::table('posts')
        ->where('id',$request->id)
        ->delete();
        //  return redirect('/post/delete');
        return back();
    }

//  プルダウンメニュー作成
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id('category_id');
            $table->string('category_name', 255);
            $table->timestamps();
        });
    }

    // テストログインしているユーザーの投稿一覧
    public function user(){
        $user = auth()->user();
        $posts = DB::table('posts')
            ->join('users','posts.user_id','=','users.id')
            ->select('posts.id','posts.posts')
            ->where('users.id',Auth::id())
            ->get();
        return view('posts.user',compact('posts'));
    }
}

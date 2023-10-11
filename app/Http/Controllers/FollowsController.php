<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Post;
use App\Follow;

class FollowsController extends Controller
{
    //フォローしている人の投稿リスト
    public function followList(Post $post, Follow $follow)
    {
        $user = auth()->user();
        $follow_ids = $follow->followingIds($user->id);
        // dd($follow_ids);
        if($follow_ids->isEmpty()){
            $timelines = collect();
        } else {
            $timelines = $post->getFollowTimelines( $follow_ids);
        }
        $icons = DB::table('users')
            ->whereIn('id', $follow_ids)
            ->get();
        return view('Follows.followList',['timelines' => $timelines, 'icons' => $icons, 'user' => $user ]);
    }

    //フォロワーリスト
    public function followerList(Post $post, Follow $follow)
    {
        $user = auth()->user();
        $follow_ids = $follow->followerIds($user->id);
        if($follow_ids->isEmpty()){
            $timelines = collect();
        } else {
            $timelines = $post->getFollowTimelines( $follow_ids);
        }
        $icons = DB::table('users')
            ->whereIn('id', $follow_ids)
            ->get();
            // dd($follow_ids);
        return view('Follows.followerList',['timelines' => $timelines, 'icons' => $icons, 'user' => $user ]);
    }

    // フォローする
    public function create(Request $request){
        $id=$request->id;
        
        DB::table('follows')
        ->insert([
            'follow' => $id,
            'follower' => Auth::id(),
            'created_at' => now()
        ]);
        return back();

    }
    // フォロー外す
    public function delete(Request $request){
        $id=$request->id;
        DB::table('follows')
        ->where([
            'follow' => $id,
            'follower' => Auth::id(),
        ])->delete();
        return back();

    }

    //ログインユーザーだけが使える
    public function __construct()
    {
        $this->middleware('auth');
    }

}


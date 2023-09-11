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
    //フォローリスト
    public function followList(Post $post, Follow $follow)
    {
        $user = auth()->user();
        $follow_ids = $follow->followingIds($user->id);
        $timelines = $post->getFollowTimelines( $follow_ids);
        $icons = DB::table('users')
            ->whereIn('id', $follow_ids)
            ->get();
            // dd($follow_ids);
        return view('Follows.followList',['timelines' => $timelines, 'icons' => $icons, 'user' => $user ]);
    }

    //フォロワーリスト
    public function followerList(Post $post, Follow $follow)
    {
        $user = auth()->user();
        $follow_ids = $follow->followerIds($user->id);
        $timelines = $post->getFollowTimelines( $follow_ids);
        $icons = DB::table('users')
            ->whereIn('id', $follow_ids)
            ->get();
            // dd($follow_ids);
        return view('Follows.followerList',['timelines' => $timelines, 'icons' => $icons, 'user' => $user ]);
    }

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

        // フォロー数とフォロワー数取得
    
    }
    }


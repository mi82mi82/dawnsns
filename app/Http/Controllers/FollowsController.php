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
    //
    public function followList(){
        $user = auth()->user();
        $is_following = $login_user->isFollowing($login_user->id);
        $is_followed = $login_user->isFollowed($login_user->id);
        $follow_count = $follow->getFollowCount($login_user->id);
        $follower_count = $follow->getFollowerCount($login_user->id);

        return view('follows.followList',[
            'user'           => $user,
            'is_following'   => $is_following,
            'is_followed'    => $is_followed,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count
        ]);
    }
    public function followerList(){
        return view('follows.followerList');
    }

    //ログインユーザーだけが使える
    public function __construct()
    {
        $this->middleware('auth');
    }
}

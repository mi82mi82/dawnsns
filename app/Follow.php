<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    // フォローリスト
    protected $fillable = [
        'follow', 'follower'
      ];

    public function followingIds(Int $user_id)
  {
      return $this->where('follower', $user_id)->pluck('follow');
  }

  // // フォロワーリスト
  public function followerIds(Int $user_id)
  {
      return $this->where('follow', $user_id)->pluck('follower');
  }


}

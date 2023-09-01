<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = [
        'follow', 'follower'
      ];

    public function followingIds(Int $user_id)
  {
      return $this->where('follower', $user_id)->pluck('follow');
  }

}

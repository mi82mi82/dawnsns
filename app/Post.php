<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id', 'post',
    ];

    public function getTimeLines(Int $user_id, Array $follow_ids)
      {
          return $this->whereIn('user_id', $follow_ids)->orWhere('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
      }

      public function getFollowTimeLines($follow_ids)
      {
        if( is_array($follow_ids)){
            return $this->whereIn('user_id', $follow_ids)->orderBy('created_at', 'DESC')->get();
        } else {
            return $this->where('user_id', $follow_ids)->orderBy('created_at', 'DESC')->get();
        }
      }

      public function user()
    {
        return $this->belongsTo('App\User');
    }

}

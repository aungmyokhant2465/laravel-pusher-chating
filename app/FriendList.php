<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendList extends Model
{
    public function User() {
        return $this->belongsTo('App\User','friend_id');
    }
}

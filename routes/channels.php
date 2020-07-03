<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.{receiver_id}', function($user, $receiver_id) {
    if(Auth::check()){
        $user = Auth::user();
        return true;
    }else {
        return null;
    }
});

Broadcast::channel('user-status', function() {
    if(Auth::check()){
        $user = Auth::user();
        return ['id'=>$user->id,'name'=>$user->name];
    }else {
        return null;
    }
});

Broadcast::channel('try-or-not.{receiver_id}.{user_id}', function($user, $receiver_id, $user_id) {
    if(Auth::check()){
        $user = Auth::user();
        return ['id'=>$user->id];
    }else {
        return null;
    }
});

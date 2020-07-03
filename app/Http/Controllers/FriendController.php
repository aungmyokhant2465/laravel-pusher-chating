<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FriendList;
use App\User;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function index()
    {   
        $allFriends = FriendList::where('user_id',Auth::id())->get();
        $requests = [];
        $friends = [];
        foreach($allFriends as $friend) {
            if(!$friend->confirm) {
                array_push($requests, $friend);
            }else {
                array_push($friends, $friend);
            }
        }
        return view('friends')->with(['friends'=>$friends, 'requests'=>$requests]);
        // $friends = FriendList::where([['user_id', Auth::id()],['confirm', 1]])->get();
        // $request = 
    }

    public function friends()
    {   
        $allFriends = FriendList::where('user_id',Auth::id())->with('User')->get();
        $friends = [];
        foreach($allFriends as $friend) {
            if($friend->confirm) {
                array_push($friends, $friend);
            }
        }
        return $friends;
    }

    public function request(Request $request)
    {   
        $from = $request['from'];
        $to = $request['to'];
        $friended = FriendList::where([['user_id',$to],['friend_id',$from]])->first();
        $flag = -1;
        if($friended){
            $friended->delete();
        }else {
            $friend = new FriendList();
            $friend->user_id = $to;
            $friend->friend_id = $from;
            $friend->save();
            // $fri = new FriendList();
            // $fri->user_id = $from;
            // $fri->friend_id = $to;
            // $fri->save();
            $flag = $to;
        }

        $unFriends = [];
        foreach(Auth::user()->Friends as $friend) {
            array_push($unFriends, $friend->friend_id);
        }
        array_push($unFriends, Auth::id());
        $users = User::whereNotIn('id',$unFriends)->get();

        return view('home')->with(['users'=>$users, 'done'=>$flag]);
    }

    public function confirm($friend_id) {
        $friend = FriendList::where([['friend_id', $friend_id],['user_id', Auth::id()]])->first();
        $friend->confirm = true;
        $friend->update();
        // $fri = FriendList::where([['friend_id', Auth::id()],['user_id', $friend_id]])->first();
        // $fri->confirm = true;
        // $fri->update();
        $fri = new FriendList();
        $fri->user_id = $friend->friend_id;
        $fri->friend_id = $friend->user_id;
        $fri->confirm = true;
        $fri->save();
        return redirect()->back();
    }

    public function reject($friend_id) {
        $friend = FriendList::where([['friend_id', $friend_id],['user_id', Auth::id()]])->first();
        $friend->delete();
        return redirect()->back();
    }
}

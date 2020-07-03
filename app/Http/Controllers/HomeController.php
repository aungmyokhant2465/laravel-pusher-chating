<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\FriendList;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $unFriends = [];
        foreach(Auth::user()->Friends as $friend) {
            array_push($unFriends, $friend->friend_id);
        }
        array_push($unFriends, Auth::id());
        $users = User::whereNotIn('id',$unFriends)->get(); 
        return view('home')->with(['users'=>$users, 'done'=>-1]);
    }

}

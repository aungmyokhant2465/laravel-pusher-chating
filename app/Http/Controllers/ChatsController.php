<?php

namespace App\Http\Controllers;
use App\Message;
use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Events\MessageSent;
use App\Events\UserStatus;

class ChatsController extends Controller
{
    public function index()
    {
        broadcast(new UserStatus(Auth::user()))->toOthers();
        return view('chatBox');
    }

    public function fetchMessages($receiver_id)
    {
        $messages = Message::where([['user_id', Auth::id()],['receiver_id', $receiver_id]])->orWhere([['user_id', $receiver_id],['receiver_id', Auth::id()]])->get();
        return $messages;
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        $message = new Message();
        $message->message = $request['message'];
        $message->user_id = $user->id;
        $message->receiver_id = $request['receiver_id'];
        $message->save();
        $receiver_id = $request['receiver_id'];

        broadcast(new MessageSent($user, $message, $receiver_id))->toOthers();
        return ['status' => 'Message Sent!'];

    }

}

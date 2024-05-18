<?php

namespace App\Http\Controllers;

use App\Events\ChatHistory;
use Illuminate\Http\Request;
use App\Models\ChatMessage;

class ChatController extends Controller
{
    public function getMessages()
    {

        $messages = ChatMessage::orderBy('created_at', 'desc')->take(15)->get();
        return $messages;
    }

    public function storeMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
        ]);
        $user_id = $_COOKIE['user_id'];
        $username = $_COOKIE['username'];

        $user = $user_id;

        $message = new ChatMessage();
        $message->user_id = $user_id;
        $message->username = $username;
        $message->message = $request->message;
        $message->save();

        event(new ChatHistory($this->recent_chathistory()));

        return response()->json(['success' => true]);
    }

    public function recent_chathistory()
    {
        $recent_chats = ChatMessage::orderBy('id', 'desc')->latest()->first();
        return $recent_chats;
    }
}

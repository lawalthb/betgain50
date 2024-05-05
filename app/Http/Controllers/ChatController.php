<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatMessage;

class ChatController extends Controller
{
    public function getMessages()
    {
        $messages = ChatMessage::with('user')->orderBy('created_at', 'asc')->take(15)->latest()->get();
        return $messages;
    }

    public function storeMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
        ]);
        $user_id = $_COOKIE['user_id'];

        $user = $user_id;

        $message = new ChatMessage();
        $message->user_id = $user_id;
        $message->message = $request->message;
        $message->save();

        return response()->json(['success' => true]);
    }
}

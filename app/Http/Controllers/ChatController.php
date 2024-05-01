<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatMessage;

class ChatController extends Controller
{
    public function getMessages()
    {
        $messages = ChatMessage::with('user')->orderBy('created_at', 'asc')->take(10)->get();
        return $messages;
    }

    public function storeMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $user = auth()->user();

        $message = new ChatMessage();
        $message->user_id = $user->id;
        $message->message = $request->message;
        $message->save();

        return response()->json(['success' => true]);
    }
}

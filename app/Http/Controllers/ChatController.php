<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Events\herosboard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    //Ensure only Authenticated users get here
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index(Request $request){
        // to for pusher to display chat   
        $text = $request->text;
        $name =$request->username;
        $username =0; $amount=0; $point =0;

        // sending chat to DB -- but still need to send user image to message table
            DB::table('messages')->insert([
                'message' => $request->text,
                'user_id' => $request->user_id,
                'username' => $request->username,
                //'user_image' => $request->user_image,
            ]);
           
            //broadcast
            event(new herosboard($text,$name,$username, $amount,$point));
            
    }

    public function fetchMessages()
    {
        //Return All Messages and user information
        return Message::with('user')->get();
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        $message = $user->messages()->create([
            'message' => $request->text
        ]);
        return ['status' => 'Message Sent!'];
    }
}

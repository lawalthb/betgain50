<?php

namespace App\Http\Controllers;

use App\Models\BetEntry;
use App\Events\herosboard;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function index()
    {
        //Display History on Homepage
        $betEntries = BetEntry::all(); //Show all, but it can be conditional e.g retrieve past one hour only

        return view('history', compact('betEntries'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'bet_amount' => 'required|numeric',
            'bet_crash' => 'required|numeric',
        ]);

        BetEntry::create([
            'user_id' => Auth::user()->id,
            'bet_amount' => $request->bet_amount,
            'bet_crash' => $request->bet_crash,
        ]);

        return back();
    }

    public function setbet(Request $request)
    {
        // dd('i dey here, setbet');
        // to for pusher to display chat
        $text = "";
        $name = "";
        $username = $request->username;
        $amount = $request->bet_amount;
        $point = $request->bet_crash;

        $token = $request->token;
        $busted_value = $request->busted_value;
        $game_status = "Ongame";
        $amount_multiplier = $amount * $point;

        $request->validate([
            'bet_amount' => 'required|numeric',
            'bet_crash' => 'required|numeric',
        ]);
        //dd($request);
        // sending chat to DB -- but still need to send user image to message table



        $lastID = DB::table('bet_entries')->insertGetId([
            'bet_amount' => $request->bet_amount,
            'bet_crash' => $request->bet_crash,
            'user_id' => $request->user_id,
            'token' => $token,
            'busted_value' => $busted_value,
            'game_status' => $game_status,
            'amount_multiplier' => $amount_multiplier,

        ]);
        DB::table('transactions')->insert([
            'reference' => 'bet' . $lastID,
            'email' => "bet@herosbet.com",
            'amount' => '-' . $request->bet_amount,
            'status' => 'success',
            'user_id' => $request->user_id,

        ]);
        event(new herosboard($text, $name, $username, $amount, $point, $token, $game_status, $amount_multiplier));

        return response()->json(['status' => true, 'message' => 'Bet Entry Successfully Made', 'lastID' => $lastID]);
    }

    public function check_if_win(Request $request)
    {
        $text = "";
        $name = "";
        $user_id = $request->user_id;
        $user_bet_id = $request->user_bet_id;
        $request->validate([
            'user_id' => 'required|numeric',
            'user_bet_id' => 'required|numeric',
        ]);
        if ($request->user_bet_id) {
            $query = DB::table('bet_entries')->where('id', $user_bet_id)
                ->where('user_id', $user_id)
                ->where('game_status', "Ongame")
                ->first();
            $querybv = DB::table('busted_value_tb')
                ->where('user_id', $user_id)
                ->latest()
                ->first();
            $busted_value =  $querybv->busted_value;
            $amount_multiplier =  $query->amount_multiplier;
            $bet_crash =  $query->bet_crash;
            //   dd($busted_value);
            if ($busted_value >= $bet_crash) {
                //if user win
                //add new record to transactions table to add money
                DB::table('transactions')->insert([
                    'reference' => 'win' . $user_bet_id,
                    'email' => "bet@herosbet.com",
                    'amount' => $amount_multiplier,
                    'status' => 'success',
                    'user_id' => $request->user_id,

                ]);
                // update his bet entery if win or loose
                DB::table('bet_entries')
                    ->where('id', $user_bet_id)
                    ->update(['game_status' => 'Win']);
                return response()->json(['status' => true, 'message' => 'you Won!!!']);
            } else {
                DB::table('bet_entries')
                    ->where('id', $user_bet_id)
                    ->update(['game_status' => 'Loose']);
                return response()->json(['status' => false, 'message' => 'loose']);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'no bet']);
        }




        event(new herosboard($text, $name, $username, $amount, $point, $token, $game_status, $amount_multiplier));
    }

    public function fetchMessages()
    {
        //Return All Messages and user information
        return BetEntry::with('user')->get();
    }

    public function previous_game(Request $request)
    {

        return BetEntry::where('user_id', $request->user_id)->get()->last();
    }



    public function fetchAdverts()
    {
        //Return All Messages and user information
        return
            DB::table('adverts')->where('is_active', '=', 'Yes')
            ->orderBy('position')->get();
    }


    public function save_busted_value(Request $request)
    {
        // save busted value
        DB::table('busted_value_tb')->insert([
            'busted_value' => $request->busted_value,
            'user_id' => $request->user_id
        ]);
    }




    public function cashout_win(Request $request)
    {
        $text = "";
        $name = "";
        $user_id = $request->user_id;
        $user_bet_id = $request->user_bet_id;
        $user_bet_amount = $request->user_bet_amount;
        $request->validate([
            'user_id' => 'required|numeric',
            'user_bet_id' => 'required|numeric',
        ]);
        if ($request->user_bet_id) {
            $query = DB::table('bet_entries')->where('id', $user_bet_id)
                ->where('user_id', $user_id)
                ->where('game_status', "Ongame")
                ->first();
            $querybv = DB::table('busted_value_tb')
                ->where('user_id', $user_id)
                ->latest()
                ->first();
            $busted_value =  $querybv->busted_value;
            $bet_crash =  $query->bet_crash;
            //   dd($busted_value);

            //add new record to transactions table to add money
            DB::table('transactions')->insert([
                'reference' => 'cashout' . $user_bet_id,
                'email' => "bet@herosbet.com",
                'amount' => $user_bet_amount,
                'status' => 'success',
                'user_id' => $request->user_id,

            ]);
            // update his bet entery if win or loose
            DB::table('bet_entries')
                ->where('id', $user_bet_id)
                ->update(['game_status' => 'Win']);
            return response()->json(['status' => true, 'message' => 'Nice one!!!']);
        } else {
            return response()->json(['status' => false, 'message' => 'no bet']);
        }




        // event(new herosboard($text,$name,$username, $amount,$point, $token, $game_status,$amount_multiplier));


    }
}

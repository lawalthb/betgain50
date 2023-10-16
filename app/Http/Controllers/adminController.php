<?php

namespace App\Http\Controllers;

use App\Models\BetEntry;
use App\Models\Message;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function manage_users()
    {
        $users = User::latest()->paginate(10);
        $totalusers = User::count();

        return view('manage_users', compact('users', 'totalusers'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }
    public function search_user(Request $request)
    {
        // dd($request);

        $users = User::where('username', 'like', "%$request->username%")->paginate(5);

        return view('manage_users', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function manage_transactions()
    {
        $transaction = Transaction::latest()->paginate(10);
        $amount_deposit = Transaction::where('reference', 'not like', '%win%')->where('reference', 'not like', '%bet%')
            ->where('status', 'like', 'success')->sum('amount');
        $amount_bet = Transaction::where('reference', 'like', '%bet%')->sum('amount');
        $amount_bet = abs($amount_bet);
        $amount_win = Transaction::where('reference', 'like', '%win%')->sum('amount');

        $amount_available = $amount_deposit + $amount_bet - $amount_win;

        $amount_available = number_format($amount_available, 2);
        return view('manage_transactions', compact('transaction', 'amount_available'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function manage_games()
    {
        $games = BetEntry::latest()->paginate(10);

        return view('manage_game_history', compact('games'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function manage_wallets()
    {
        $wallets  = Transaction::distinct()
            ->select('user_id')->paginate(10);

        return view('manage_user_wallet', compact('wallets'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }





    public function manage_adverts()
    {

        $adverts  = DB::table('adverts')->get();
        // dd($adverts);
        try {
            return view('manage_adverts')->with(["adverts" => $adverts]);
        } catch (Exception $e) {

            $message = $e->getMessage();
            var_dump('Exception Message: ' . $message);

            $code = $e->getCode();
            var_dump('Exception Code: ' . $code);

            $string = $e->__toString();
            var_dump('Exception String: ' . $string);

            exit;
        }
    }

    public function manage_adverts_add()
    {
        return view('manage_adverts_add');
    }

    public function manage_adverts_edit(Request $request)
    {

        $adverts =  DB::table('adverts')
            ->where('id', '=', $request->advert_id)->get();

        return view('manage_adverts_edit')->with(["adverts" => $adverts]);
    }

    public static function get_user_wallet_balance($user_id)
    {
        $balance =  DB::table('transactions')
            ->where('user_id', '=', $user_id)
            ->where('status', '=', 'success')
            ->sum('amount');
        return number_format($balance);
    }

    public function manage_chats()
    {
        $chats = Message::latest()->paginate(10);

        return view('manage_chats', compact('chats'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }
    public function admin_tweak_game()
    {
        $settings = Setting::latest()->paginate(20);

        return view('admin_tweak_game', compact('settings'))
            ->with('i', (request()->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function advert_store(Request $request)
    {
        //dd($request);
        $company_name = $request->company_name;
        $product_name = $request->product_name;

        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $email = $request->email;
        $link = $request->link;
        $position = $request->position;
        $amount = $request->amount;
        $is_active = $request->is_active;
        $is_active = ($request->is_active == 'on') ? 'Yes' : 'No';

        // dd($is_admin);
        $request->validate([
            'image' => 'required',
            'company_name' => 'required',
        ]);
        $imageName = time() . '.' . $request->image->extension();
        if ($request->image) {
            $request->image->move(public_path('assets/adverts'), $imageName);
            $image_path = 'assets/adverts/' . $imageName;
        }
        try {
            DB::table('adverts')->insert([
                'company_name' => $company_name,
                'product_name' => $product_name,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'email' => $email,
                'position' => $position,
                'link' => $link,
                'amount' => $amount,
                'is_active' => $is_active,
                'image' => $image_path,
                'is_default' => 1
            ]);
        } catch (Exception $e) {

            $message = $e->getMessage();
            var_dump('Exception Message: ' . $message);

            $code = $e->getCode();
            var_dump('Exception Code: ' . $code);

            $string = $e->__toString();
            var_dump('Exception String: ' . $string);

            exit;
        }
        return redirect()->route('manageAdverts')
            ->with('success', 'Advert added successfully');
    }

    public function advert_update(Request $request)
    { //

        $company_name = $request->company_name;
        $product_name = $request->product_name;

        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $email = $request->email;
        $link = $request->link;
        $position = $request->position;
        $title = $request->title;
        $amount = $request->amount;
        $is_active = $request->is_active;
        $is_active = ($request->is_active == 'on') ? 'Yes' : 'No';

        // dd($is_admin);
        $request->validate([
            'image' => 'required',
            'company_name' => 'required',
        ]);
        $imageName = time() . '.' . $request->image->extension();
        if ($request->image) {
            $request->image->move(public_path('assets/adverts'), $imageName);
            $image_path = 'assets/adverts/' . $imageName;
        }
        try {
            DB::table('adverts')->update([
                'company_name' => $company_name,
                'product_name' => $product_name,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'email' => $email,
                'position' => $position,
                'title' => $title,
                'link' => $link,
                'amount' => $amount,
                'is_active' => $is_active,
                'image' => $image_path,
                'is_default' => 1
            ]);
        } catch (Exception $e) {

            $message = $e->getMessage();
            var_dump('Exception Message: ' . $message);

            $code = $e->getCode();
            var_dump('Exception Code: ' . $code);

            $string = $e->__toString();
            var_dump('Exception String: ' . $string);

            exit;
        }
        return redirect()->route('manageAdverts')
            ->with('success', 'Advert Edited successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_user(Request $request, User $users)
    {
        $user_id = $request->user_id;

        DB::table('users')->where('id', $user_id)->delete();

        return redirect()->route('manageUsers')
            ->with('success', 'Users deleted successfully');
    }
    public function delete_transactions(Request $request, User $users)
    {
        $user_id = $request->user_id;

        DB::table('transactions')->where('id', $user_id)->delete();

        return redirect()->route('manageTransactions')
            ->with('success', 'Transaction deleted successfully');
    }

    public function delete_game(Request $request)
    {
        $game_id = $request->game_id;

        DB::table('bet_entries')->where('id', $game_id)->delete();

        return redirect()->route('manageGames')
            ->with('success', 'Game deleted successfully');
    }


    public function delete_chat(Request $request)
    {
        $chat_id = $request->chat_id;

        DB::table('messages')->where('id', $chat_id)->delete();

        return redirect()->route('manageChats')
            ->with('success', 'Chat deleted successfully');
    }

    public function delete_advert(Request $request)
    {
        $advert_id = $request->Advert_id;

        DB::table('adverts')->where('id', $advert_id)->delete();

        return redirect()->route('manageAdverts')
            ->with('success', 'Advert deleted successfully');
    }


    public function ban_users(Request $request, User $users)
    {
        $user_id = $request->user_id;
        $ban = $request->ban;
        if ($ban == "Banned") {
            DB::table('users')
                ->where('id', $user_id)
                ->update(['user_role' => 'user']);
            return redirect()->route('manageUsers')
                ->with('success', 'User is now Active successfully');
        } else {
            DB::table('users')
                ->where('id', $user_id)
                ->update(['user_role' => 'banned']);
            return redirect()->route('manageUsers')
                ->with('success', 'User is now Banned successfully');
        }
    }


    public function message_show(Request $request)
    {
        $chat_id = $request->chat_id;
        $show = $request->show;
        if ($show == "Showing") {
            DB::table('messages')
                ->where('id', $chat_id)
                ->update(['status' => 'Hidden']);
            return redirect()->route('manageChats')
                ->with('success', 'Chat is now Hidden Successfully');
        } else {
            DB::table('messages')
                ->where('id', $chat_id)
                ->update(['status' => 'Showing']);
            return redirect()->route('manageChats')
                ->with('success', 'Chat is now Showing successfully');
        }
    }

    // dashboard
    //get all visits


    public function adminDashboard(Request $request)
    {
        $totalVisits = number_format(Visitor::count(), 0);
        $totalGames = number_format(BetEntry::count(), 0);
        $totalAmount = number_format(BetEntry::sum('bet_amount'), 2);
        $totalWalletAmount = number_format(Transaction::sum('amount'), 2);
        $totalAmountBetLose = number_format(BetEntry::where('game_status', 'Loose')->sum('bet_amount'), 2);

        function chart_value($startDate, $endDate, $betType)
        {
            return BetEntry::whereBetween('created_at', [$startDate, $endDate])->where('game_status', $betType)->sum('bet_amount');
        }

        $jan_winbet =       chart_value('2023-01-01', '2023-01-31', 'Win');
        $feb_winbet =       chart_value('2023-02-01', '2023-02-28', 'Win');
        $mar_winbet =       chart_value('2023-03-01', '2023-03-31', 'Win');
        $apr_winbet =       chart_value('2023-04-01', '2023-04-30', 'Win');
        $may_winbet =       chart_value('2023-05-01', '2023-05-31', 'Win');
        $jun_winbet =       chart_value('2023-06-01', '2023-06-30', 'Win');
        $jul_winbet =       chart_value('2023-07-01', '2023-07-31', 'Win');
        $aug_winbet =       chart_value('2023-08-01', '2023-08-31', 'Win');

        $sep_winbet =       chart_value('2023-09-01', '2023-09-31', 'Win');
        $oct_winbet =       chart_value('2023-10-01', '2023-10-31', 'Win');
        $nov_winbet =       chart_value('2023-11-01', '2023-11-30', 'Win');
        $dec_winbet =       chart_value('2023-12-01', '2023-12-31', 'Win');

        $jan_losebet =       chart_value('2023-01-01', '2023-01-31', 'Loose');
        $feb_losebet =       chart_value('2023-02-01', '2023-02-28', 'Loose');
        $mar_losebet =       chart_value('2023-03-01', '2023-03-31', 'Loose');
        $apr_losebet =       chart_value('2023-04-01', '2023-04-30', 'Loose');
        $may_losebet =       chart_value('2023-05-01', '2023-05-31', 'Loose');
        $jun_losebet =       chart_value('2023-06-01', '2023-06-30', 'Loose');
        $jul_losebet =       chart_value('2023-07-01', '2023-07-31', 'Loose');
        $aug_losebet =       chart_value('2023-08-01', '2023-08-31', 'Loose');

        $sep_losebet =       chart_value('2023-09-01', '2023-09-31', 'Loose');
        $oct_losebet =       chart_value('2023-10-01', '2023-10-31', 'Loose');
        $nov_losebet =       chart_value('2023-11-01', '2023-11-30', 'Loose');
        $dec_losebet =       chart_value('2023-12-01', '2023-12-31', 'Loose');



        //dd($jan_bet);
        return  view('admin', compact(
            'totalVisits',
            'totalGames',
            'totalAmount',
            'totalWalletAmount',
            'totalAmountBetLose',
            'jan_winbet',
            'feb_winbet',
            'mar_winbet',
            'apr_winbet',
            'may_winbet',
            'jun_winbet',
            'jul_winbet',
            'aug_winbet',
            'sep_winbet',
            'oct_winbet',
            'nov_winbet',
            'dec_winbet',

            'jan_losebet',
            'feb_losebet',
            'mar_losebet',
            'apr_losebet',
            'may_losebet',
            'jun_losebet',
            'jul_losebet',
            'aug_losebet',
            'sep_losebet',
            'oct_losebet',
            'nov_losebet',
            'dec_losebet',
        ));
        // view('admin');

    }
}

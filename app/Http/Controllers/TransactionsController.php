<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class TransactionsController extends Controller
{
    public function initialize_tranx(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'phone' => ['nullable', 'numeric'],
            'amount' => ['required', 'integer'],
            'reference' => ['required', 'string', 'unique:transactions'],
            'callback_url' => ['required', 'url'],
        ]);

        $amount = $request->amount * 100;
        $body = ['amount' => $amount, 'email' => $request->email, 'reference' => $request->reference, 'callback_url' => $request->callback_url];

        //dd($body);
        $url = env('PAYSTACK_TRANSACTION_URL', "https://api.paystack.co/transaction/initialize");
        $token = env('PAYSTACK_KEY');

        $response = Http::withToken($token)->withHeaders(['content-type' => 'application/json'])
            ->post($url, $body);

        if ($response->successful()) {
            $response = $response->json();

            $transaction = Transaction::create([
                'user_id' => $request->user_id,
                'email' => $request->email,
                'phone' => $request->phone,
                'amount' => $request->amount,
                'reference' => $request->reference,
                'authorization_url' => $response['data']['authorization_url'] ?? 'null', //'https://checkout.paystack.com/0peioxfhpn',
                'callback_url' => $request->callback_url
            ]);

            // $created_transaction = new TransactionResource($transaction);

            return response()->json([
                'status' => true,
                'message' => 'Authorization URL created',
                'transaction' => $transaction
            ], 201);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'An error occured',
                'gateway_response' => $response->json()
            ], 400);
        }
    }

    public function verify_tranx($reference)
    {


        $url = env('PAYSTACK_VERIFY_URL', "https://api.paystack.co/transaction/verify/");
        $url = $url . $reference;
        $token = env('PAYSTACK_KEY');

        $response = Http::withToken($token)->withHeaders(['content-type' => 'application/json'])
            ->get($url);

        if ($response->ok()) {
            $response = $response->json();
            //dd($response);
            $email = $response['data']['customer']['email'];
            $upd =  DB::table('transactions')
                ->where('reference', $reference)
                ->where('status', 'Pending')
                ->update([
                    'gateway_response' => $response['data']['gateway_response'],
                    'status' => $response['data']['status'],
                ]);

            $user_id = $_COOKIE['user_id'];


            if ($upd) {
                $get_deposit_amt  =  Transaction::where('user_id', $user_id)->where('reference', $reference)->value('amount');

                $user_balance  =  User::where('id', $user_id)->where('email', $email)->value('wallet_balance');


                DB::table('users')
                    ->where('id', $user_id)

                    ->update([
                        'wallet_balance' => $user_balance  + ($response['data']['amount'] / 100),
                    ]);
            }
            $gateway_response = [
                'status' => true,
                "message" => "Verification successful",
                "data" => [
                    "id" => $response['data']['id'],
                    "domain" => $response['data']['domain'],
                    "status" => $response['data']['status'],
                    "reference" => $response['data']['reference'],
                    "receipt_number" => $response['data']['receipt_number'],
                    "amount" => $response['data']['amount'] / 100,
                    "message" => $response['data']['message'],
                    "gateway_response" => "Successful",
                    "paid_at" => "2023-06-21T04:37:44.000Z",
                    "created_at" => $response['data']['created_at'],
                    "channel" => $response['data']['channel'],
                    "currency" => $response['data']['currency'],
                    "ip_address" => $response['data']['ip_address'],
                ],
            ];

            return response()->json([
                'status' => true,
                'message' => 'Transaction Retrieved',
                'gateway_response' => $gateway_response
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'An error occured',
                'gateway_response' => $response->json()
            ], 400);
        }
    }

    public function user_tranx($id)
    {
        $transactions = Transaction::where('user_id', $id)->get();
        if ($transactions) {

            return response()->json([
                'status' => true,
                'message' => 'User Transactions Retrieved',
                'transactions' => $transactions,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'User Transaction Not found',
                'transactions' => $transactions,
            ], 404);
        }
    }

    public function tranx_list()
    {
        $transactions = Transaction::paginate(100);
        return response()->json([
            'status' => true,
            'message' => 'Transactions Retrieved',
            'transactions' => $transactions,
        ], 200);
    }

    public function callback()
    {
        $reference = $_GET['reference'];
        //dd($reference);
        $verify_payment = $this->verify_tranx($reference);
        if ($verify_payment) {
            return redirect(url('/'))->with('payment_msg', 'Deposited Successfully');
        } else {
            dd($reference . " Does not exit");
        }
    }


    public function user_balance($id)
    {
        // $balance =  DB::table('transactions')
        //     ->where('user_id', '=', $id)
        //     ->where('status', '=', 'success')
        //     ->where('money_type', '=', 'real')
        //     ->sum('amount');
        $balance =  User::where('id', $id)->value('wallet_balance');

        if ($balance) {

            return response()->json([
                'status' => true,
                'message' => 'User Transactions Retrieved',
                'balance' => $balance,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'User Transaction Not found',
                'balance' => $balance,
            ], 500);
        }
    }


    public function user_bonus($id)
    {
        $balance =  DB::table('transactions')
            ->where('user_id', '=', $id)
            ->where('status', '=', 'success')
            ->where('money_type', '=', 'bonus')
            ->sum('amount');

        if ($balance) {

            return response()->json([
                'status' => true,
                'message' => 'User Transactions Retrieved',
                'balance' => $balance,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'User Transaction Not found',
                'balance' => $balance,
            ], 404);
        }
    }



    public function transfer_approval($ref)
    {
        $ref_details =  DB::table('transfers')
            ->where('reference', '=', $ref)->first();
        $ref_details->id;

        if ($ref_details) {
            $transaction =   Transaction::create([
                'user_id' => $ref_details->user_id,
                'email' => $ref_details->email,
                'phone' => $ref_details->phone,
                'amount' => '-' . $ref_details->user_amount,
                'reference' => 'wdr' . $ref_details->user_id,
                'authorization_url' => 'null',
                'callback_url' => 'null',
                'gateway_response' => 'Successful',
                'money_type' => 'real',
                'status' => 'success'
            ]);

            return redirect('/');
        } else {
            echo "error";
        }
    }
}

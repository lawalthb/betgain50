<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Doctrine\DBAL\Types\JsonType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use App\Models\Transaction;

class TransferController extends Controller
{
  public function bank_list()
  {
    $url = env("PAYSTACK_BANK_URL", "https://api.paystack.co/bank?country=nigeria&type=nuban&currency=NGN");
    $token = env('PAYSTACK_KEY');
    $response = Http::withToken($token)->withHeaders(['content-type' => 'application/json'])
      ->get($url);

    if ($response->ok()) {
      $response = $response->json();

      // Map through the data array and pick only the fields necessary
      $transformedData = array_map(function ($item) {
        return [
          'name' => $item['name'],
          'slug' => $item['slug'],
          'code' => $item['code'],
        ];
      }, $response['data']);

      $gateway_response = [
        'status' => $response['status'] ?? true,
        "message" => $response['message'] ?? "Banks retrieved",
        "data" => $transformedData,
        "meta" => $response['meta'] ?? "null",
      ];

      return response()->json([
        'status' => true,
        'message' => 'Banks Retrieved',
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


  public function resolve_account(Request $request)
  {
    $request->validate([
      'account_number' => ['required', 'numeric'],
      'bank_code' => ['required'],
    ]);

    $url = env("PAYSTACK_RESOLVE", "https://api.paystack.co/bank/resolve");
    $url .= '?account_number=' . $request->account_number . '&bank_code=' . $request->bank_code;
    $recipientURL = env("PAYSTACK_CREATE_RECIPIENT", "https://api.paystack.co/transferrecipient");
    $token = env('PAYSTACK_KEY');
    $bankCode = $request->bank_code;
    $response = Http::withToken($token)->withHeaders(['content-type' => 'application/json'])
      ->get($url);

    if ($response->ok()) {
      $response = $response->json();

      $gateway_response =  $response['data'];

      //     //Create Transfer Recipient
      $reference = (string) Str::uuid();
      $recipientName = $response['data']['account_name'];
      $recipientAccount = $response['data']['account_number'];
      $recipientData = [
        "type" => "nuban",
        "name" => $recipientName,
        "account_number" => $recipientAccount,
        "bank_code" => $bankCode,
        "currency" => "NGN"
      ];
      $recipientResponse = Http::withToken($token)->withHeaders(['content-type' => 'application/json'])
        ->post($recipientURL, $recipientData);
      if ($recipientResponse->successful()) {
        $recipientResponse = $recipientResponse->json();
        $recipientCode = $recipientResponse['data']['recipient_code'];


        Transfer::create([
          "reference" =>  $reference,
          "email" => Auth::user()->email ?? null,
          "phone" => Auth::user()->phone_number,
          "account_number" => $recipientAccount,
          "recipient_code" => $recipientCode,
          "bank_code" => $bankCode,
          "name" => $recipientName,
          "amount" => $request->amount,
          "user_amount" => $request->user_amount,
          "user_id" => Auth::user()->id,
        ]);

        return response()->json([
          'status' => true,
          'message' => 'Account number resolved',
          'gateway_response' => $gateway_response,
          'reference' => $reference,
          'recipient_code' => $recipientCode,
          'error' => null,
        ], 200);
      } else {
        Transfer::create([
          "reference" =>  $reference,
          "email" => Auth::user()->email ?? null,
          "phone" => Auth::user()->phone_number ?? null,
          "account_number" => $recipientAccount,
          "bank_code" => $bankCode,
          "name" => $recipientName,
          "amount" => $request->amount,
          "user_id" => Auth::user()->id,
        ]);

        return response()->json([
          'status' => true,
          'message' => 'Account number resolved',
          'gateway_response' => $gateway_response,
          'amount' => $request->amount,
          'recipient_code' => null,
          'error' => $recipientResponse,
        ], 200);
      }

      // return response()->json([
      //           'status' => true,
      //           'message' => 'Account number resolved',
      //           'gateway_response' => $gateway_response,

      //       ], 200);


    } else {
      return response()->json([
        'status' => false,
        'message' => 'An error occured',
        'gateway_response' => $response->json()
      ], 500);
    }
  }


  public function initiate_transfer(Request $request)
  {
    $request->validate([
      'amount' => ['required', 'numeric'],
      'recipient_code' => ['required'],
      'reference' => ['required', 'exists:transfers,reference'],
    ]);

    $url = env("PAYSTACK_TRANSFER", "https://api.paystack.co/transfer");
    $token = env('PAYSTACK_KEY');

    //Create Transfer request
    $transferData = [
      "amount" => $request->amount * 100,
      "recipient" => $request->recipient_code,
      "source" => "balance",
      "reason" => "Withdrawal",
      "reference" => $request->reference
    ];
    $transferResponse = Http::withToken($token)->withHeaders(['content-type' => 'application/json'])
      ->post($url, $transferData);

    if ($transferResponse->successful()) {
      $transferResponse = $transferResponse->json();

      return response()->json([
        'status' => true,
        'message' => 'Transfer Initiated Successfully',
        'reference' => $request->reference,
        'gateway_response' => $transferResponse,
      ], 200);
    } else {
      return response()->json([
        'status' => false,
        'message' => 'An error occured',
        'reference' => $request->reference,
        'gateway_response' => $transferResponse->json(),
      ], 500);
    }
  }

  public function verify_transfer($reference, $password, $user_id)
  {
    //verify user password first;
    $user_password =  DB::table('users')
      ->where('id', '=', $user_id)->value('pin');

    if ($password == $user_password) {

      $url = env("PAYSTACK_TRANSFER_VERIFY", "https://api.paystack.co/transfer/verify/");
      $url = $url . $reference;
      $token = env('PAYSTACK_KEY');

      $response = Http::withToken($token)->withHeaders(['content-type' => 'application/json'])
        ->get($url);

      if ($response->ok()) {
        $response = $response->json();

        DB::table('transfers')
          ->where('reference', $reference)
          ->update([
            'amount' => $response['data']['amount'] / 100,
            'status' => $response['data']['status'],
          ]);

        $gateway_response = [
          "id" => $response['data']['id'],
          "recipient" => $response['data']['recipient'],
          "status" => $response['data']['status'],
          "reference" => $response['data']['reference'],
          "transfer_code" => $response['data']['transfer_code'],
          "amount" => $response['data']['amount'] / 100,
          "currency" => $response['data']['currency'],
        ];



        return response()->json([
          'status' => true,
          'message' => 'Transfer Retrieved',
          'data' => $gateway_response
        ], 200);
      } else {
        return response()->json([
          'status' => false,
          'message' => 'An error occured',
          'data' => $response->json()
        ], 500);
      }
    } else {
      return response()->json([
        'status' => false,
        'message' => 'PIN is not correct',

      ], 500);
    }
  }
  public function bank_list_within()
  {

    $bank_select_list =
      DB::select('select * from banks where status like ?', ["On"]);
    // dd($bank_select_list);
    return
      response()->json([
        'status' => true,
        'message' => 'Transfer Retrieved',
        'data' => $bank_select_list
      ], 200);
  }

  public function create_recipient(Request $request)
  {
    $request->validate([
      'account_number' => ['required', 'numeric'],
      'bank_code' => ['required'],
      'name' => 'required'
    ]);
    $recipientURL = env("PAYSTACK_CREATE_RECIPIENT", "https://api.paystack.co/transferrecipient");
    $token = env('PAYSTACK_KEY');
    //Create Transfer Recipient
    $recipientName = $request->name;
    $recipientAccount = $request->account_number;
    $bankCode = $request->bank_code;

    $recipientData = [
      "type" => "nuban",
      "name" => $recipientName,
      "account_number" => $recipientAccount,
      "bank_code" => $bankCode,
      "currency" => "NGN"
    ];
    $recipientResponse = Http::withToken($token)->withHeaders(['content-type' => 'application/json'])
      ->post($recipientURL, $recipientData);

    if ($recipientResponse->ok()) {
      $recipientResponse = $recipientResponse->json();
      $gateway_response = [
        'status' => $recipientResponse['status'],
        "message" => $recipientResponse['message'],
        "data" => $recipientResponse['data'],
      ];

      $recipientCode = $recipientResponse['data']['recipient_code'];

      return response()->json([
        'status' => true,
        'message' => 'Transfer Recipient Created',
        'gateway_response' => $gateway_response,
        'recipient_code' => $recipientCode,
      ], 200);
    } else {
      return response()->json([
        'status' => false,
        'message' => 'An error occured',
        'gateway_response' => $recipientResponse->json()
      ], 400);
    }
  }


  public function check_wpin(Request $request)
  {
    $request->validate([
      'wpin' => ['required', 'numeric']
    ]);
    $user_password =  DB::table('users')
      ->where('id', '=',  $request->user_id)->value('pin');

    if ($request->wpin == $user_password) {
      return response()->json([
        'status' => true,
        'message' => 'Pin is valid',

      ], 200);
    } else {
      return response()->json([
        'status' => false,
        'message' => 'Invalid pin',

      ], 200);
    }
  }
}

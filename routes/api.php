<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\TransferController;
use App\Models\Setting;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/transactions/mybalance/{user_id}', [TransactionsController::class, 'user_balance']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/adverts', [HistoryController::class, 'fetchAdverts']);
Route::get('/transfers/verify/{reference}/{password}/{user_id}', [TransferController::class, 'verify_transfer'])->name('verify_transfer');
//Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/user-info/{id}', [AuthController::class, 'get_user_info']);

    //Transations
    Route::post('/setbet', [HistoryController::class, 'setbet'])->name('setbet');
    Route::post('/check_if_win', [HistoryController::class, 'check_if_win'])->name('check_if_win');
    Route::post('/cashout_win', [HistoryController::class, 'cashout_win'])->name('cashout_win');

    Route::get('/transactions/user/{id}', [TransactionsController::class, 'user_tranx']);
    Route::get('/transactions/list', [TransactionsController::class, 'tranx_list']);
    Route::get('/transactions/user_balance/{user_id}', [TransactionsController::class, 'user_balance']);
    Route::get('/transactions/user_bonus/{user_id}', [TransactionsController::class, 'user_bonus']);
    Route::post('/transactions/initialize', [TransactionsController::class, 'initialize_tranx'])->name('api_deposit');

    //Transfers
    Route::get('/transfers/bank_list', [TransferController::class, 'bank_list']);
    Route::get('/transfers/bank_list_within', [TransferController::class, 'bank_list_within']);
    Route::get('transfers/resolve_account', [TransferController::class, 'resolve_account'])->name('resolve_account');

    Route::post('transfers/initiate', [TransferController::class, 'initiate_transfer'])->name('initiate_transfer');;
    Route::post('transfers/recipient', [TransferController::class, 'create_recipient'])->name('create_recipient');
});

//Auth
Route::post('/auth/login', [AuthController::class, 'login'])->name('api-login');
Route::post('/auth/register', [AuthController::class, 'signup']);
Route::post('auth/verify-signup', [AuthController::class, 'signup_verification']);
Route::post('auth/resend-token', [AuthController::class, 'resend_token']);
Route::post('save_busted_value', [HistoryController::class, 'save_busted_value']);

Route::get('/settings', [SettingController::class, 'index']);
//Forgot Password
Route::post('/auth/forget-password', [AuthController::class, 'forget_password'])->name('forgot_password');
Route::post('/auth/reset-password', [AuthController::class, 'reset_password']);


Route::get('/previous_game/{user_id}', [HistoryController::class, 'previous_game'])->name('previous_game');

Route::get('/transactions/verify/{reference}', [TransactionsController::class, 'verify_tranx']);
//get all game history on page load

Route::get('/history/list', [HistoryController::class, 'fetchMessages']);

//get all chats on page load
Route::get('/chats/list', [ChatController::class, 'fetchMessages']);

<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\TransactionsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PaystackWebhookController;
use App\Http\Controllers\VisitorController;

Route::view('/', 'index');
Route::view('/sender', 'sender');

Route::post('/paystack/webhook', [PaystackWebhookController::class, 'handleWebhook']);
Route::get('/transfer_approval/{ref}', [TransactionsController::class, 'transfer_approval']);

Route::post('/sender', [ChatController::class, 'index']);
Route::post('/setbet', [HistoryController::class, 'setbet'])->name('setbet')->middleware('auth:sanctum');
Route::post('/play', [HistoryController::class, 'store'])->middleware('auth:sanctum');
Route::get('/callback', [TransactionsController::class, 'callback']);
Route::post('/edit_profile', [AuthController::class, 'edit_profile'])->name('edit_profile');

//admin routes



Route::post('/admin/login', [AdminAuthController::class, 'postLogin'])->name('adminLoginPost');
Route::get('/admin/login', function () {
    return view('auth/login');
})->name('adminLogin');


Route::group(['middleware' => 'adminauth'], function () {
    Route::get('/admin', [adminController::class, 'adminDashboard'])->name('adminDashboard');


    Route::DELETE('/admin/users', [adminController::class, 'delete_user'])->name('deleteUser');
    Route::DELETE('/admin/transactions', [adminController::class, 'delete_transactions'])->name('deleteTransaction');
    Route::DELETE('/admin/games', [adminController::class, 'delete_game'])->name('deleteGame');
    Route::DELETE('/admin/chats', [adminController::class, 'delete_chat'])->name('deleteChat');
    Route::DELETE('/admin/adverts', [adminController::class, 'delete_advert'])->name('deleteAdverts');

    Route::DELETE('/admin/admins', [adminController::class, 'delete_admin'])->name('deleteAdmin');

    Route::get('/admin/users', [adminController::class, 'manage_users'])->name('manageUsers');
    Route::get('/admin/transactions', [adminController::class, 'manage_transactions'])->name('manageTransactions');
    Route::get('/admin/games', [adminController::class, 'manage_games'])->name('manageGames');
    Route::get('/admin/chats', [adminController::class, 'manage_chats'])->name('manageChats');
    Route::get('/admin/wallets', [adminController::class, 'manage_wallets'])->name('manageWallets');
    Route::get('/admin/adverts', [adminController::class, 'manage_adverts'])->name('manageAdverts');
    Route::get('/admin/adverts/add', [adminController::class, 'manage_adverts_add'])->name('manageAdvertsAdd');

    Route::get('/admin/adverts/edit/{advert_id}', [adminController::class, 'manage_adverts_edit'])->name('Advert_edit');

    Route::get('/admin/admins/edit/{admin_id}', [adminController::class, 'manage_admin_edit'])->name('Admin_edit');

    Route::post('/admin/settings/update', [SettingController::class, 'update'])->name('update_settings');


    Route::post('/admin/adverts/edit', [adminController::class, 'advert_update'])->name('edit_advert');
    Route::post('/admin/adverts/add', [adminController::class, 'advert_store'])->name('store_advert');
    Route::get('/admin/tweak_game', [adminController::class, 'admin_tweak_game'])->name('admin_tweak_game');

    Route::get('/admin/ban_user', [adminController::class, 'ban_users'])->name('banUser');
    Route::get('/admin/message_show', [adminController::class, 'message_show'])->name('messageShow');

    //Route::get('/admin/verify_transaction', [adminController::class, 'transaction_users'])->name('TransactionUser');

    Route::post('/admin/users', [adminController::class, 'search_user'])->name('search_user');

    Route::get('/admin/visitors', [VisitorController::class, 'index'])->name('visitors_log');

    Route::get('/admin/logout', [AdminAuthController::class, 'adminLogout'])->name('adminLogout');

    Route::get('/admin/admin_edit_profile/{id}', [adminController::class, 'edit_profile'])->name('admin_edit_profile');

    Route::post('/admin/update_admin_profile', [adminController::class, 'update_admin_profile'])->name('update_admin_profile');


    Route::post('/admin/manage_admin_update', [adminController::class, 'manage_admin_update'])->name('manage_admin_update');

    Route::post('/admin/adminPassowrdReset', [adminController::class, 'adminPassowrdReset'])->name('adminPassowrdReset');



    Route::get('/admin/admins', [adminController::class, 'manage_admins'])->name('manage_admins');

    Route::get('/admin/add_admin', [adminController::class, 'manage_admin_add'])->name('manage_admin_add');

    Route::post('/admin/add_admin', [adminController::class, 'manage_admin_store'])->name('manage_admin_store');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WalletController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/wallet/balance', [WalletController::class, 'balance'])->name('balance');
Route::get('/wallet/add', [WalletController::class, 'add'])->name('wallet.add');
Route::post('/wallet/add', [WalletController::class, 'add_post'])->name('wallet.add.post');
Route::get('/wallets', [WalletController::class, 'wallets'])->name('wallets');
Route::get('/wallet/transfer', [WalletController::class, 'transfer'])->name('wallet.transfer');
Route::post('/wallet/transfer', [WalletController::class, 'transfer_post'])->name('wallet.transfer.post');
Route::post('/wallet/transfer/user', [WalletController::class, 'transfer_user_post'])->name('wallet.transfer_user.post');
Route::post('/user/wallets', [WalletController::class, 'user_wallets'])->name('user_wallets');

Route::get('/wallet/transaction', [WalletController::class, 'transaction'])->name('wallet.transaction');


Route::get('auth/social', [App\Http\Controllers\Auth\LoginController::class, 'show'])->name('social.login');
Route::get('oauth/{driver}', [App\Http\Controllers\Auth\LoginController::class, 'redirectToProvider'])->name('social.oauth');
Route::get('oauth/{driver}/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleProviderCallback'])->name('social.callback');
//http://physical.money/oauth/facebook/callback
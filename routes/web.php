<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/user-create', [UserController::class, 'index']);
Route::get('/user-login', [UserController::class, 'loginPage'])->name('login.index');
Route::post('/users', [UserController::class, 'store'])->name('user.store');
Route::post('/login', [UserController::class, 'login'])->name('login');
// Route::get('/', [TransactionController::class, 'index']);
Route::get('/depositindex', [TransactionController::class, 'depositindex'])->name('deposit.index');
Route::get('/withdrawindex', [TransactionController::class, 'withdrawindex'])->name('withdraw.index');
Route::post('/deposit-store', [TransactionController::class, 'deposit'])->name('deposit.store');
Route::get('/withdrawal', [TransactionController::class, 'showWithdrawals']);
Route::get('/deposit', [TransactionController::class, 'showDeposit']);
Route::post('/withdrawal', [TransactionController::class, 'withdraw'])->name('withdraw.store');

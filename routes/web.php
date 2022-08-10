<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


Route::get('/profile', [App\Http\Controllers\HomeController::class, 'index'])->name('profile');
Route::post('/profile', [App\Http\Controllers\TransactionsController::class, 'createTransaction'])->name('transaction.create');

Route::get('/transactions', [App\Http\Controllers\TransactionsController::class, 'allTransactions'])->name('transactions.all');


Auth::routes();

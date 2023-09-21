<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TransactionController;

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



Auth::routes();


Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    Route::resource('clients', ClientController::class);
    Route::resource('users', UserController::class);

    Route::get('/transactions/reports', [App\Http\Controllers\HomeController::class, 'index'])->name('transactions.reports');
    Route::resource('transactions', TransactionController::class);



    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

});





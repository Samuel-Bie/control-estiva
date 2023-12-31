<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthorizationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::prefix('auth')->group(function () {
    Route::post('token', [AuthorizationController::class, 'token']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('whoami', [AuthorizationController::class, 'whoami']);
        Route::post('logout', [AuthorizationController::class, 'logout']);
    });
});





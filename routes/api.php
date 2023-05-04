<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\NewController;

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


Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout' , [AuthController::class, 'logout'])->name('shopper-logout');
});

Route::post('/register' , [AuthController::class, 'register'])->name('shopper-register');
Route::post('/login' , [AuthController::class, 'login'])->name('shopper-login');

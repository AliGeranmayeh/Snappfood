<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\NewController;
use App\Http\Controllers\api\ShopperAddressController;
use App\Http\Controllers\api\RestaurantController;
use App\Http\Controllers\api\UserInfoController;

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
    Route::post('/addresses' , [ShopperAddressController::class, 'add'])->name('add-address');
    Route::get('/addresses' , [ShopperAddressController::class, 'get'])->name('get-user-addresses');
    Route::patch('/addresses/{address_id}' , [ShopperAddressController::class, 'update'])->name('update-address');
    Route::get('/user_info' , [UserInfoController::class, 'index'])->name('get-user-info');
    Route::patch('/user_info' , [UserInfoController::class, 'update'])->name('update-user-info');
});
Route::post('/register' , [AuthController::class, 'register'])->name('shopper-register');
Route::post('/login' , [AuthController::class, 'login'])->name('shopper-login');
Route::get('/restaurants/{restaurant_id}' , [RestaurantController::class, 'index']);
Route::patch('/restaurants' , [RestaurantController::class, 'search']);
Route::get('/restaurants/{restaurant_id}/foods' , [RestaurantController::class, 'foods']);

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\NewController;
use App\Http\Controllers\api\ShopperAddressController;
use App\Http\Controllers\api\RestaurantController;
use App\Http\Controllers\api\UserInfoController;
use App\Http\Controllers\api\CartController;
use App\Http\Controllers\api\CommentController;



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

#phase2
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout' , [AuthController::class, 'logout'])->name('shopper-logout');
    Route::post('/addresses' , [ShopperAddressController::class, 'add'])->name('add-address');
    Route::get('/addresses' , [ShopperAddressController::class, 'get'])->name('get-user-addresses');
    Route::patch('/addresses/{address_id}' , [ShopperAddressController::class, 'update'])->name('update-address');
    Route::get('/user_info' , [UserInfoController::class, 'index'])->name('get-user-info');
    Route::patch('/user_info' , [UserInfoController::class, 'update'])->name('update-user-info');
    #phase3👇👇
    Route::get('/carts' , [CartController::class , 'index'])->name('show-user-carts');
    Route::get('/carts/{cart_id}' , [CartController::class , 'getCartInfo'])->name('show-user-cart');
    Route::get('/carts/{cart_id}/pay' , [CartController::class , 'peyForCart'])->name('pay-for-cart');
    Route::post('/cart/add' , [CartController::class , 'add'])->name('add-cart');
    Route::patch('/cart/add' , [CartController::class , 'update'])->name('update-cart');
    #phase3👆👆
    #pasee4👇👇
    Route::get('/comments' , [CommentController::class , 'index'])->name('show-user-comments');

    #pasee4👆👆
});
Route::post('/register' , [AuthController::class, 'register'])->name('shopper-register');
Route::post('/login' , [AuthController::class, 'login'])->name('shopper-login');
Route::get('/restaurants/{restaurant_id}' , [RestaurantController::class, 'index']);
Route::get('/restaurants' , [RestaurantController::class, 'search']);
Route::get('/restaurants/{restaurant_id}/foods' , [RestaurantController::class, 'foods']);

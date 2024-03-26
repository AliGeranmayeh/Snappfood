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



/* |-------------------------------------------------------------------------- | API Routes |-------------------------------------------------------------------------- | | Here is where you can register API routes for your application. These | routes are loaded by the RouteServiceProvider and all of them will | be assigned to the "api" middleware group. Make something great! | */

#phase2
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class , 'logout'])->name('logout');
    Route::post('/addresses', [ShopperAddressController::class , 'add'])->name('user.address.add');
    Route::get('/addresses', [ShopperAddressController::class , 'get'])->name('user.address.all');
    Route::patch('/addresses/{address_id}', [ShopperAddressController::class , 'update'])->name('user.address.update');
    Route::get('/user_info', [UserInfoController::class , 'index'])->name('user.info');
    Route::patch('/user_info', [UserInfoController::class , 'update'])->name('user.info.update');
    Route::get('/carts', [CartController::class , 'index'])->name('user.carts');
    Route::get('/carts/{cart_id}', [CartController::class , 'getCartInfo'])->name('user.cart');
    Route::get('/carts/{cart_id}/pay', [CartController::class , 'peyForCart'])->name('cart.pay');
    Route::post('/cart/add', [CartController::class , 'add'])->name('cart.add');
    Route::patch('/cart/add', [CartController::class , 'update'])->name('cart.update');
    Route::get('/comments', [CommentController::class , 'index'])->name('user.comments.update');
    Route::post('/{order_id}/comment', [CommentController::class , 'addComment'])->name('comment.add');
    Route::get('/comments/food/{food_id}', [CommentController::class , 'foodComments'])->name('food.comments.show');
    Route::get('/comments/restaurant/{restaurant_id}', [CommentController::class , 'restaurantComments'])->name('restaurant.comments');

});
Route::post('/register', [AuthController::class , 'register'])->name('shopper.register');
Route::post('/login', [AuthController::class , 'login'])->name('shopper.login');
Route::get('/restaurants/{restaurant_id}', [RestaurantController::class , 'index'])->name('shoper.resturants.list');
Route::get('/restaurants', [RestaurantController::class , 'search'])->name('shoper.resturants.search');
Route::get('/restaurants/{restaurant_id}/foods', [RestaurantController::class , 'foods'])->name('shoper.resturant.foods');;

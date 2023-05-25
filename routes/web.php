<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Restaurant\OrderController;
use App\Http\Controllers\Restaurant\CommentController;


/* |-------------------------------------------------------------------------- | Web Routes |-------------------------------------------------------------------------- | | Here is where you can register web routes for your application. These | routes are loaded by the RouteServiceProvider and all of them will | be assigned to the "web" middleware group. Make something great! | */



Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
                return view('admin.admin-panel');
            }
            );
            Route::get('/users', [App\Http\Controllers\Admin\UsersController::class , 'index'])->name('users');
            Route::get('/user/{id}', [App\Http\Controllers\Admin\UserController::class , 'index'])->name('user');
            Route::get('/food_categories', [App\Http\Controllers\Admin\FoodCategoryController::class , 'index'])->name('food-category');
            Route::post('/food_categories', [App\Http\Controllers\Admin\FoodCategoryController::class , 'post'])->name('post-food-category');
            Route::get('/restaurant_categories', [App\Http\Controllers\Admin\RestaurantCategoryController::class , 'index'])->name('restaurant-category');
            Route::post('/restaurant_categories', [App\Http\Controllers\Admin\RestaurantCategoryController::class , 'post'])->name('post-restaurant-category');
            Route::get('/discount', [App\Http\Controllers\Admin\DiscountController::class , 'index'])->name('get-discount');
            Route::post('/discount', [App\Http\Controllers\Admin\DiscountController::class , 'post'])->name('post-discount');
        }); 
});

Auth::routes();
 Route::middleware(['auth' ,'owner'])->group(function () {
    #phase1
    Route::get('/', [App\Http\Controllers\HomeController::class , 'index'])->name('home');
    Route::post('/', [App\Http\Controllers\HomeController::class , 'post'])->name('post-home');
    Route::get('/restaurantProfile', [App\Http\Controllers\Restaurant\ProfileController::class , 'index'])->name('restaurant-profile');
    Route::post('/restaurantProfile', [App\Http\Controllers\Restaurant\ProfileController::class , 'create'])->name('post-restaurant-profile');
    Route::get('/editRestaurantProfile', [App\Http\Controllers\Restaurant\EditRestaurantProfileController::class , 'index'])->name('edit-restaurant-profile');
    Route::post('/editRestaurantProfile', [App\Http\Controllers\Restaurant\EditRestaurantProfileController::class , 'update'])->name('update-restaurant-profile');
    Route::get('/discount', [App\Http\Controllers\Restaurant\DiscountController::class , 'index'])->name('get-owner-discount');
    Route::post('/discount', [App\Http\Controllers\Restaurant\DiscountController::class , 'post'])->name('post-owner-discount');
    Route::get('/food', [App\Http\Controllers\Restaurant\AddFoodController::class , 'index'])->name('get-add-food-page');
    Route::post('/food', [App\Http\Controllers\Restaurant\AddFoodController::class , 'create'])->name('create-food');
    Route::get('/edit_food/{id}', [App\Http\Controllers\Restaurant\EditFoodController::class , 'index'])->name('get-edit-food');
    Route::post('/edit_food/{id}', [App\Http\Controllers\Restaurant\EditFoodController::class , 'update'])->name('edit-food');


    #phase3👇👇
    Route::get('/orders', [OrderController::class , 'index'])->name('show-order-page');
    Route::post('/orders', [OrderController::class , 'post'])->name('filter-order-page');
    #phase3👆👆

    #phase4👇👇
    Route::get('/check_comments', [CommentController::class , 'index'])->name('get-not-confirmed-comments');
    #phase4👆👆
 });

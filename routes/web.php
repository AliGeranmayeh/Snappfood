<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Restaurant\OrderController;
use App\Http\Controllers\Restaurant\CommentController;
use App\Http\Controllers\Restaurant\ConfirmedCommentController;
use App\Http\Controllers\Admin\RestaurantsController;


/* |-------------------------------------------------------------------------- | Web Routes |-------------------------------------------------------------------------- | | Here is where you can register web routes for your application. These | routes are loaded by the RouteServiceProvider and all of them will | be assigned to the "web" middleware group. Make something great! | */



Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('admin')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\HomeController::class , 'index'])->name('admin.panel');
            Route::get('/users', [App\Http\Controllers\Admin\UsersController::class , 'index'])->name('users');
            Route::get('/food_categories', [App\Http\Controllers\Admin\FoodCategoryController::class , 'index'])->name('foods.category');
            Route::post('/food_categories', [App\Http\Controllers\Admin\FoodCategoryController::class , 'post'])->name('foods.category.post');
            Route::get('/restaurant_categories', [App\Http\Controllers\Admin\RestaurantCategoryController::class , 'index'])->name('restaurants.category');
            Route::post('/restaurant_categories', [App\Http\Controllers\Admin\RestaurantCategoryController::class , 'post'])->name('restaurants.category.post');
            Route::get('/discount', [App\Http\Controllers\Admin\DiscountController::class , 'index'])->name('discounts.get');
            Route::post('/discount', [App\Http\Controllers\Admin\DiscountController::class , 'post'])->name('discounts.post');
            Route::get('/comments', [\App\Http\Controllers\Admin\CommentController::class , 'index'])->name('comments.admin');
            Route::get('/comments/confirm_delete/{comment_id}', [\App\Http\Controllers\Admin\CommentController::class , 'confirmDelete'])->name('comments.delete.confirm');
            Route::get('/comments/decline_delete/{comment_id}', [\App\Http\Controllers\Admin\CommentController::class , 'declineDelete'])->name('comments.delete.decline');
            Route::get('/restaurants', [RestaurantsController::class , 'index'])->name('admin.restaurants');
        }
        );
    });

Auth::routes();
Route::middleware(['auth', 'owner'])->group(function () {
    #phase1
    Route::get('/', [App\Http\Controllers\HomeController::class , 'index'])->name('owner.home');
    Route::post('/', [App\Http\Controllers\HomeController::class , 'post'])->name('owner.home.post');
    Route::get('/restaurantProfile', [App\Http\Controllers\Restaurant\ProfileController::class , 'index'])->name('restaurant.profile');
    Route::post('/restaurantProfile', [App\Http\Controllers\Restaurant\ProfileController::class , 'create'])->name('restaurant.profile.post');
    Route::get('/editRestaurantProfile', [App\Http\Controllers\Restaurant\EditRestaurantProfileController::class , 'index'])->name('restaurant.profile.edit.get');
    Route::post('/editRestaurantProfile', [App\Http\Controllers\Restaurant\EditRestaurantProfileController::class , 'update'])->name('restaurant.profile.edit');
    Route::get('/discount', [App\Http\Controllers\Restaurant\DiscountController::class , 'index'])->name('owner.discount.get');
    Route::post('/discount', [App\Http\Controllers\Restaurant\DiscountController::class , 'post'])->name('owner.discount.post');
    Route::get('/food', [App\Http\Controllers\Restaurant\AddFoodController::class , 'index'])->name('food.add.page');
    Route::post('/food', [App\Http\Controllers\Restaurant\AddFoodController::class , 'create'])->name('food.add');
    Route::get('/edit_food/{id}', [App\Http\Controllers\Restaurant\EditFoodController::class , 'index'])->name('food.edit.page');
    Route::post('/edit_food/{id}', [App\Http\Controllers\Restaurant\EditFoodController::class , 'update'])->name('food.edit');
    Route::get('/orders', [OrderController::class , 'index'])->name('order.page');
    Route::post('/orders', [OrderController::class , 'post'])->name('order.filter');
    Route::get('/check_comments', [CommentController::class , 'index'])->name('comments.not.confirmed');
    Route::get('/check_comments/delete/{comment_id}', [CommentController::class , 'deleteComment'])->name('comments.not.confirmed.delete');
    Route::get('/check_comments/confirm/{comment_id}', [CommentController::class , 'confirmComment'])->name('owner.comments.confirm');
    Route::get('/comments', [ConfirmedCommentController::class , 'index'])->name('comments.confirmed.page');
    Route::post('/comments/reply/{comment_id}', [ConfirmedCommentController::class , 'replyComment'])->name('comments.confirmed.reply');
    Route::get('/comments/reply/{comment_id}', [ConfirmedCommentController::class , 'selectComment'])->name('comments.confirmed.reply.select');
    Route::get('/comments/delete_request/{comment_id}', [ConfirmedCommentController::class , 'deleteRequest'])->name('comments.delete.request');
    Route::get('/comments/filter/filter={filter_id}', [ConfirmedCommentController::class , 'filterComments'])->name('comments.filter');
});

Route::fallback(function () {
    return view('not_found');
});

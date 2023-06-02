<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Restaurant\OrderController;
use App\Http\Controllers\Restaurant\CommentController;
use App\Http\Controllers\Restaurant\ConfirmedCommentController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\RestaurantsController;


/* |-------------------------------------------------------------------------- | Web Routes |-------------------------------------------------------------------------- | | Here is where you can register web routes for your application. These | routes are loaded by the RouteServiceProvider and all of them will | be assigned to the "web" middleware group. Make something great! | */



Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('admin')->group(function () {
                Route::get('/', [App\Http\Controllers\Admin\HomeController::class , 'index'])->name('admin-main-page');
                Route::get('/users', [App\Http\Controllers\Admin\UsersController::class , 'index'])->name('users');
                Route::get('/user/{id}', [App\Http\Controllers\Admin\UserController::class , 'index'])->name('user');
                Route::get('/food_categories', [App\Http\Controllers\Admin\FoodCategoryController::class , 'index'])->name('food-category');
                Route::post('/food_categories', [App\Http\Controllers\Admin\FoodCategoryController::class , 'post'])->name('post-food-category');
                Route::get('/restaurant_categories', [App\Http\Controllers\Admin\RestaurantCategoryController::class , 'index'])->name('restaurant-category');
                Route::post('/restaurant_categories', [App\Http\Controllers\Admin\RestaurantCategoryController::class , 'post'])->name('post-restaurant-category');
                Route::get('/discount', [App\Http\Controllers\Admin\DiscountController::class , 'index'])->name('get-discount');
                Route::post('/discount', [App\Http\Controllers\Admin\DiscountController::class , 'post'])->name('post-discount');
                #phase4👇👇
                Route::get('/comments', [\App\Http\Controllers\Admin\CommentController::class , 'index'])->name('get-adminside-comments');
                Route::get('/comments/confirm_delete/{comment_id}', [\App\Http\Controllers\Admin\CommentController::class , 'confirmDelete'])->name('confirm-delete-comment');
                Route::get('/comments/decline_delete/{comment_id}', [\App\Http\Controllers\Admin\CommentController::class , 'declineDelete'])->name('decline-delete-comment');
                Route::get('/banners', [BannerController::class , 'index'])->name('get-banners');
                Route::post('/banners', [BannerController::class , 'post'])->name('create-or-update-banners');
                #phase4👆👆
                #review-phase👇👇
                Route::get('/restaurants', [RestaurantsController::class , 'index'])->name('show-restaurant-page');
                #review-phase👆👆
            }
            );
        
});

Auth::routes();
Route::middleware(['auth', 'owner'])->group(function () {
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
    Route::get('/check_comments/delete/{comment_id}', [CommentController::class , 'deleteComment'])->name('delete-not-confirmed-comment');
    Route::get('/check_comments/confirm/{comment_id}', [CommentController::class , 'confirmComment'])->name('confirm-comments');
    Route::get('/comments', [ConfirmedCommentController::class , 'index'])->name('get-confirmed-comments');
    Route::post('/comments/reply/{comment_id}', [ConfirmedCommentController::class , 'replyComment'])->name('add-reply');
    Route::get('/comments/reply/{comment_id}', [ConfirmedCommentController::class , 'selectComment'])->name('select-comment-reply');
    Route::get('/comments/delete_request/{comment_id}', [ConfirmedCommentController::class , 'deleteRequest'])->name('request-to-delete-confirmed-comment');
    Route::get('/comments/filter/filter={filter_id}', [ConfirmedCommentController::class , 'filterComments'])->name('filter-comments');
#phase4👆👆
});

 #review-phase👇👇
 Route::fallback(function () {
    return view('not_found');
});
 #review-phase👆👆


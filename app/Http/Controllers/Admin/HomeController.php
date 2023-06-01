<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use App\Models\Restaurant;
use App\Models\Discount;
use App\Models\FoodCategory;
use App\Models\RestaurantCategory;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->limit(2)->get();
        $restaurants = Restaurant::orderBy('created_at', 'desc')->limit(2)->get();
        $discounts = Discount::orderBy('created_at', 'desc')->limit(2)->get();
        $food_categories = FoodCategory::limit(2)->get();
        $restaurant_categories = RestaurantCategory::limit(2)->get();
        
        
        return view('admin.admin-panel',[
            'users' => $users,
            'restaurants'=>$restaurants,
            'discounts' => $discounts,
            'food_categories' => $food_categories,
            'restaurant_categories' => $restaurant_categories
        ]);
    }
}

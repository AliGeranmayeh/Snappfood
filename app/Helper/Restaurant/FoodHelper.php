<?php


namespace App\Helper\Restaurant;
use App\Models\Food;
use App\Models\FoodCategory;


class FoodHelper

{
    public static function getRestaurantFoods()
    {
        return Food::forCurrentRestaurant()->get();
    }

    public static function getAllFoodCategories()
    {
        return FoodCategory::all();
    }
}

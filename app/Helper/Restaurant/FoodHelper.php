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

    public static function getSearchedFood(string|null $search_field ,int $food_category_filter){
        return Food::query()->forCurrentRestaurant()->when(
            $search_field != null &&
            $food_category_filter != 0,
            fn($query) =>
                $query->where('name', 'like', "%$search_field%")
                ->where('type_id', $food_category_filter)
        )->when(
            $search_field != null,
            fn($query) =>
                $query->where('name', 'like', "%$search_field%")
        )->when(
            $food_category_filter != 0,
            fn($query) =>
                $query->where('type_id', $food_category_filter))
        ->get();
    }

    public static function createFood(array $data){
        Food::create($data);
    }
}

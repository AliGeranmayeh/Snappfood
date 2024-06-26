<?php 

namespace App\Helper\Restaurant;
use App\Models\Restaurant;
use App\Models\RestaurantCategory;


class RestaurantHelper  
{
    public static function getThisRestaurant()
    {
        return Restaurant::thisRestaurant()->first();
    }

    public static function getAllRestaurantCategories()
    {
        return  RestaurantCategory::all();;
    }

    public static function getThisRestaurantCategory()
    {
        return  static::getThisRestaurant()->type ?? null;
    }

    public static function createRestaurant(array $data)
    {
        Restaurant::create($data);
    }

    public static function updateRestaurant(Restaurant $restaurant, array $data)
    {
        $restaurant->update($data);
    }
}

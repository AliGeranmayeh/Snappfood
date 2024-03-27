<?php 

namespace App\Helper\Restaurant;
use App\Models\Restaurant;


class RestaurantHelper  
{
    public static function getThisRestaurant()
    {
        return Restaurant::thisRestaurant()->first();
    }
}

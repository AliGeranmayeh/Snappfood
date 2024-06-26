<?php


namespace App\Helper\Restaurant;
use App\Models\Discount;


class DiscountHelper

{

    public static function getFoodParty()
    {
        return Discount::getFoodParty()->first();
    }

    public static function getAvailableDiscounts()
    {
        return Discount::availableDiscounts()->get();
    }
}

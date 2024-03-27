<?php

namespace App\Http\Controllers\Restaurant;

use App\Models\User;
use App\Models\Restaurant;
use App\Models\RestaurantCategory;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Helper\Restaurant\RestaurantHelper;
use App\Http\Requests\RestaurantProfileRequest;


class ProfileController extends Controller
{
    public function showProfileInfoPage()
    {
        return view('restaurant_owner.profile', [
            'restaurant' => RestaurantHelper::getThisRestaurant(),
            'category' => RestaurantHelper::getThisRestaurantCategory()->name ?? null,
            'restaurant_categories' => RestaurantHelper::getAllRestaurantCategories(),
            'error' => null
        ]);
    }

    public function create(RestaurantProfileRequest $request)
    {
        RestaurantHelper::createRestaurant([
            'name' => $request->name,
            'phone' => $request->phone,
            'account' => $request->account,
            'user_id' => Auth::user()->id,
            'type_id' => $request->type,
            'address' => $request->address,
        ]);

        return redirect()->route('restaurant.profile');
    }

    public function showUpdateProfilePage()
    {
        return view('restaurant_owner.edit-profile', [
            'restaurant' => RestaurantHelper::getThisRestaurant(),
            'restaurant_category_id' => RestaurantHelper::getThisRestaurantCategory()->id ?? null,
            'restaurant_categories' => RestaurantHelper::getAllRestaurantCategories(),
            'error' => null
        ]);
    }


    public function update(RestaurantProfileRequest $request)
    {
        Restaurant::where('user_id', Auth::user()->id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'account' => $request->account,
            'user_id' => Auth::user()->id,
            'type_id' => $request->type,
            'address' => $request->address,
        ]);

        return redirect()->route('restaurant.profile');
    }

}

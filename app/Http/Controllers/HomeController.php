<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Discount;
use App\Http\Requests\FoodRequest;
use App\Models\FoodCategory;
use Illuminate\Support\Facades\Gate;
use App\Helper\Restaurant\FoodHelper;
use App\Helper\Restaurant\DiscountHelper;
use App\Http\Requests\FoodSearchFormRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('restaurant_owner.home', [
            'foods' => FoodHelper::getRestaurantFoods(),
            'food_party_id' => DiscountHelper::getFoodParty()->id ?? null,
            'food_categories' => FoodHelper::getAllFoodCategories()
        ]);
    }

    public function search(FoodSearchFormRequest $request)
    {   
        if ($request->search_field == null &&
        $request->food_category_filter == 0) {
            return redirect()->route('owner.home');
        }

        //search wanted food
        $foods = Food::query()->forCurrentRestaurant()->when(
            $request->search_field != null &&
            $request->food_category_filter != 0,
            fn($query) =>
                $query->where('name', 'like', "%$request->search_field%")
                ->where('type_id', $request->food_category_filter)
        )->when(
            $request->search_field != null,
            fn($query) =>
                $query->where('name', 'like', "%$request->search_field%")
        )->when(
            $request->food_category_filter != 0,
            fn($query) =>
                $query->where('type_id', $request->food_category_filter))
        ->get();


        return view('restaurant_owner.home', [
            'foods' => $foods,
            'food_party_id' => DiscountHelper::getFoodParty()->id ?? null,
            'food_categories' => FoodHelper::getAllFoodCategories()
        ]);

    }
}

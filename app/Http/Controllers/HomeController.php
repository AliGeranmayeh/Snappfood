<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Discount;
use App\Http\Requests\FoodRequest;
use App\Models\FoodCategory;

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
        $food_categories = FoodCategory::all();
        $restaurant_id = User::find(Auth::user()->id)->restaurant->id;
        $foods = Food::where('restaurant_id', $restaurant_id)->get();
        $food_party_id = Discount::where('name', 'Food Party')->first()->id;
        return view('restaurant_owner.home', [
            'foods' => $foods,
            'food_party_id' => $food_party_id,
            'food_categories' => $food_categories
        ]);
    }

    public function post(Request $request)
    {
        
        if ($request->has('delete')) {
           
            return $this->deleteFood($request);
        }
        elseif ($request->has('search')) {
            
            return $this->searchFood($request);
        }
        $food_categories = FoodCategory::all();
        $restaurant_id = User::find(Auth::user()->id)->restaurant->id;
        $foods = Food::where('restaurant_id', $restaurant_id)->get();
        $food_party_id = Discount::where('name', 'Food Party')->first()->id;
        return view('restaurant_owner.home', [
            'foods' => $foods,
            'food_party_id' => $food_party_id,
            'food_categories' => $food_categories
        ]);
    }

    public function deleteFood($data)
    {
        $food = Food::find($data->delete);
        $image_path = $food->image;
        if ($image_path != 'images/default.png') {
            unlink("$image_path");
        }
        Food::destroy($data->delete);

        return redirect()->route('home');
    }

    public function searchFood($data)
    {
        
        $food_categories = FoodCategory::all();
        $restaurant_id = User::find(Auth::user()->id)->restaurant->id;
        $food_party_id = Discount::where('name', 'Food Party')->first()->id;
        if ($data->search_field != null && $data->food_category_filter !=0) {
            $foods = Food::where('restaurant_id', $restaurant_id)->where('name','like',"%$data->search_field%")->where('type_id',$data->food_category_filter)->get();
            return view('restaurant_owner.home', [
                'foods' => $foods,
                'food_party_id' => $food_party_id,
                'food_categories' => $food_categories
            ]);
        }
        elseif ($data->search_field != null) {
            $foods = Food::where('restaurant_id', $restaurant_id)->where('name','like',"%$data->search_field%")->get();
            // dd($foods);
            return view('restaurant_owner.home', [
                'foods' => $foods,
                'food_party_id' => $food_party_id,
                'food_categories' => $food_categories
            ]);
        }
        elseif ($data->food_category_filter !=0) {
            $foods = Food::where('restaurant_id', $restaurant_id)->where('type_id',$data->food_category_filter)->get();
            return view('restaurant_owner.home', [
                'foods' => $foods,
                'food_party_id' => $food_party_id,
                'food_categories' => $food_categories
            ]);
        }
        else{
            return redirect()->route('home');
        }
        
    }
}

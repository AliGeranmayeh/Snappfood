<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Discount;

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
        $restaurant_id =User::find(Auth::user()->id)->restaurant->id ;
        $foods = Food::where('restaurant_id',$restaurant_id)->get();
        $food_party_id = Discount::where('name' , 'Food Party')->first()->id;
        return view('restaurant_owner.home',[
            'foods' =>$foods,
            'food_party_id' => $food_party_id
        ]);
    }
}

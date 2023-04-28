<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        return view('restaurant_owner.home',[
            'foods' =>$foods
        ]);
    }
}

<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $restaurant = User::find(Auth::user()->id)->restaurant;
        return view('restaurant_owner.profile',[
            'restaurant' => $restaurant
        ]);
    }
}

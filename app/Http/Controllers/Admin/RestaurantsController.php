<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantsController extends Controller
{   
    public function index()
    {
     return view('admin.restaurants' ,[
         'restaurants' => Restaurant::all()
     ]);   
    }
}

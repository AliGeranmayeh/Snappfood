<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{

    public function __construct() {
        $this->middleware('auth:api' , ['except' => ['login','register']]);
    }
    public function register(Request $request)
    {
        
    }

    public function login(Request $request)
    {
        
    }
}

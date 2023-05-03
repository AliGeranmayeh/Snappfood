<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\UserRequest;

class AuthController extends Controller
{

    public function __construct() {
        $this->middleware('auth:api' , ['except' => ['login','register']]);
    }
    public function register(UserRequest $request)
    {
        $request->validated();
    }

    public function login(Request $request)
    {
        
    }
}

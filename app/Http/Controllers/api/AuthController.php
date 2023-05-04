<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }
    public function register(UserRequest $request)
    {
        
        
        $user = User::create(
            // 'name' => $request['name'],
            // 'email' => $request['email'],
            // 'phone_number' => $request['phone_number'],
            // 'role' => $request['role'],
            // 'password' => Hash::make($request['password']),
            $request->validated()
        );

        return response()->json([
            'message' => 'User successfully registerd',
            'user' => $user
        ],201);
    }

    public function login(Request $request)
    {
        $creds = $request->only(['email', 'password']);
        $token =auth()->attempt($creds);

        return $token;
    }
}

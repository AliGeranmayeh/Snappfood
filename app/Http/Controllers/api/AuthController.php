<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{

    // public function __construct() {
    //     $this->middleware('auth:api', ['except' => ['login','register']]);
    // }
    public function register(UserRequest $request)
    {
        // dd($request->validated());
        $user = User::create(array_merge(
            $request->validated(),
            ['password' => Hash::make($request->password)]
        ));

        $token = $user->createToken('myAppToken')->plainTextToken;
    
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
            ]
        ],201);
    }

    public function login(LoginRequest $request)
    {

        $user = User::where('email' , $request->email)->first();

        if ( !$user || !Hash::check($request->password,$user->password)) {
            return response()->json(['error' => 'bad credentials'], 401);
        } 
        $token = $user->createToken('myAppToken')->plainTextToken;
        return response()->json([
            'message' => 'Login was successful',
            'token' => $token]
            ,200);   
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json([
            'message' => 'You are loged out'],200); 
    }

}

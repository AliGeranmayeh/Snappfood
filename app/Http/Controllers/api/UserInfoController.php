<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserInfoController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => User::find(Auth::user()->id)
        ],200);
    }
}

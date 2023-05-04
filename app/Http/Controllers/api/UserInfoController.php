<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateUserInfoRequest;

class UserInfoController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => User::find(Auth::user()->id)
        ],200);
    }

    public function update(UpdateUserInfoRequest $request)
    {
        User::where('id' , Auth::user()->id)->update($request->validated());
        return response()->json([
            'message' => 'your information updated successfully'
        ],200);
    }
}

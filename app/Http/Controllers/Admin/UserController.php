<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index($id)
    {
        $user = User::find($id);
        return view('admin.user' , [
            'user' => $user
        ]);
    }
}

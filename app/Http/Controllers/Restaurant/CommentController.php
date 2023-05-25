<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Auth::user()->restaurant->comments;
        return view('restaurant_owner.not_confirmed_comments' , [
            'comments' => $comments
        ]);
    }
}

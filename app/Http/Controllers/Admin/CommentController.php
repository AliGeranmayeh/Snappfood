<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        return view('admin.comments',[
            'comments' => Comment::where('status',2)->get(),
        ]);
    }

    
}

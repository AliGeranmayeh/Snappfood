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

    public function confirmDelete($comment_id)
    {
        Comment::find($comment_id)->delete();
        return redirect()->route('comments.admin');
    }

    public function declineDelete($comment_id)
    {
        Comment::where('id',$comment_id)->update(['status'=>1]);
        return redirect()->route('comments.admin');
    }


}

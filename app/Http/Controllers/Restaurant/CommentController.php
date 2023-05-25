<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $comments = [];
        $db_comments = Auth::user()->restaurant->comments;

        foreach ($db_comments as $db_comment) {
            if ($db_comment->status == 0) {
                $comments[] = [
                    'id' => $db_comment->id,
                    'user' => User::find($db_comment->user_id)->name,
                    'comment' => $db_comment->comment
                ];
            }
        }
        return view('restaurant_owner.not_confirmed_comments' , [
            'comments' => $comments
        ]);
    }

    public function deleteComment($comment_id)
    {
        Comment::where('id',$comment_id)->delete();
        return redirect()->route('get-not-confirmed-comments');
    }

    public function confirmComment($comment_id)
    {
        Comment::where('id',$comment_id)->update(['status' => 1]);
        return redirect()->route('get-not-confirmed-comments');
    }
}

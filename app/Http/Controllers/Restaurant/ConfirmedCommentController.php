<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class ConfirmedCommentController extends Controller
{
    public function index()
    {
        $confirmed_comments = [];
        $delete_request_comments = [];
        $db_comments = Auth::user()->restaurant->comments;

        foreach ($db_comments as $db_comment) {
            if ($db_comment->status == 1) {
                $confirmed_comments[] = [
                    'id' => $db_comment->id,
                    'user' => User::find($db_comment->user_id)->name,
                    'comment' => $db_comment->comment
                ];
            }
            elseif ($db_comment->status == 2) {
                $delete_request_comments[] = [
                    'id' => $db_comment->id,
                    'user' => User::find($db_comment->user_id)->name,
                    'comment' => $db_comment->comment
                ];
            }
        }
        return view('restaurant_owner.comments' , [
            'confirmed_comments' =>array_reverse($confirmed_comments) ,
            'delete_request_comments' =>array_reverse($delete_request_comments),
            'replied_comment' => ''
        ]);
    }

    public function deleteRequest($comment_id)
    {
        Comment::where('id',$comment_id)->update(['status' => 2]);
        return redirect()->route('get-confirmed-comments');
    }

    public function selectComment(Request $request)
    {
        $confirmed_comments = [];
        $delete_request_comments = [];
        $replied_comment  = [];
        $db_comments = Auth::user()->restaurant->comments;

        foreach ($db_comments as $db_comment) {
            if ($db_comment->status == 1) {
                $confirmed_comments[] = [
                    'id' => $db_comment->id,
                    'user' => User::find($db_comment->user_id)->name,
                    'comment' => $db_comment->comment
                ];
            }
            elseif ($db_comment->status == 2) {
                $delete_request_comments[] = [
                    'id' => $db_comment->id,
                    'user' => User::find($db_comment->user_id)->name,
                    'comment' => $db_comment->comment
                ];
            }
        }

        $replied_comment  = Comment::find($request->reply);
        return view('restaurant_owner.comments' , [
            'confirmed_comments' =>array_reverse($confirmed_comments) ,
            'delete_request_comments' =>array_reverse($delete_request_comments),
            'replied_comment' => $replied_comment
        ]);
    }
}

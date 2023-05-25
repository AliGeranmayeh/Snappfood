<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

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
            'delete_request_comments' =>array_reverse($delete_request_comments)
        ]);
    }
}

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
            if ($db_comment->status == 1 && $db_comment->parent_id == null) {
                $confirmed_comments[] = [
                    'id' => $db_comment->id,
                    'user' => User::find($db_comment->user_id)->name,
                    'comment' => $db_comment->comment,
                    'reply' => Comment::where('restaurant_id',Auth::user()->restaurant->id)->where('parent_id',$db_comment->id)->first()
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

    public function selectComment($comment_id)
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
                    'comment' => $db_comment->comment,
                    'reply' => Comment::where('restaurant_id',Auth::user()->restaurant->id)->where('parent_id',$db_comment->id)->first()
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
        $replied_comment  = Comment::find($comment_id);
        // dd($replied_comment);
        return view('restaurant_owner.comments' , [
            'confirmed_comments' =>array_reverse($confirmed_comments) ,
            'delete_request_comments' =>array_reverse($delete_request_comments),
            'replied_comment' => $replied_comment
        ]);
    }

    public function replyComment($comment_id ,Request $request)
    {
        $replied_comment = Comment::find($comment_id);
        if ($request->reply != null) {
            $comment = Comment::create([
                'user_id'=>Auth::user()->id,
                'restaurant_id'=> Auth::user()->restaurant->id,
                'order_id'=>$replied_comment->order_id,
                'cart_id'=>$replied_comment->cart_id,
                'comment' =>$request->reply,
                'parent_id' => $replied_comment->id,
                'status' => 1 //confirmed
               ]);
        }
        return redirect()->route('get-confirmed-comments');        
    }
}

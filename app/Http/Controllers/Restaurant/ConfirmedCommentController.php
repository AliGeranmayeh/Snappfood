<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\CartItem;
use App\Models\Cart;
use Illuminate\Support\Facades\Gate;
use App\Enums\CommentStatusEnum;

class ConfirmedCommentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('foods_filter')) {
            return $this->filterComments($request['foods_filter']);
        }
        $confirmed_comments = [];
        $delete_request_comments = [];
        $db_comments = Auth::user()->restaurant->comments;

        foreach ($db_comments as $db_comment) {
            if ($db_comment->status == CommentStatusEnum::CONFIRMED->value && $db_comment->parent_id == null) {
                $confirmed_comments[] = [
                    'id' => $db_comment->id,
                    'user' => User::find($db_comment->user_id)->name,
                    'comment' => $db_comment->comment,
                    'reply' => Comment::where('restaurant_id', Auth::user()->restaurant->id)->where('parent_id', $db_comment->id)->first()
                ];
            }
            elseif ($db_comment->status == CommentStatusEnum::DELETE_REQUEST->value) {
                $delete_request_comments[] = [
                    'id' => $db_comment->id,
                    'user' => User::find($db_comment->user_id)->name,
                    'comment' => $db_comment->comment
                ];
            }
        }

        return view('restaurant_owner.comments', [
            'confirmed_comments' => array_reverse($confirmed_comments),
            'delete_request_comments' => array_reverse($delete_request_comments),
            'restaurant_foods' => Auth::user()->restaurant->foods,
            'replied_comment' => ''
        ]);
    }

    public function deleteRequest($comment_id)
    {
        Comment::where('id', $comment_id)->update(['status' => CommentStatusEnum::DELETE_REQUEST->value]);
        return redirect()->route('comments.confirmed.page');
    }

    public function selectComment($comment_id)
    {

        $confirmed_comments = [];
        $delete_request_comments = [];
        $replied_comment = [];
        $db_comments = Auth::user()->restaurant->comments;

        foreach ($db_comments as $db_comment) {
            if ($db_comment->status == CommentStatusEnum::CONFIRMED->value && $db_comment->parent_id == null) {
                $confirmed_comments[] = [
                    'id' => $db_comment->id,
                    'user' => User::find($db_comment->user_id)->name,
                    'comment' => $db_comment->comment,
                    'reply' => Comment::where('restaurant_id', Auth::user()->restaurant->id)->where('parent_id', $db_comment->id)->first()
                ];
            }
            elseif ($db_comment->status == CommentStatusEnum::DELETE_REQUEST->value) {
                $delete_request_comments[] = [
                    'id' => $db_comment->id,
                    'user' => User::find($db_comment->user_id)->name,
                    'comment' => $db_comment->comment
                ];
            }
        }
        $replied_comment = Comment::find($comment_id);
        // dd($replied_comment);
        return view('restaurant_owner.comments', [
            'confirmed_comments' => array_reverse($confirmed_comments),
            'delete_request_comments' => array_reverse($delete_request_comments),
            'restaurant_foods' => Auth::user()->restaurant->foods,
            'replied_comment' => $replied_comment
        ]);
    }

    public function replyComment($comment_id, Request $request)
    {
        $replied_comment = Comment::find($comment_id);
        if ($request->reply != null) {
            $comment = Comment::create([
                'user_id' => Auth::user()->id,
                'restaurant_id' => Auth::user()->restaurant->id,
                'order_id' => $replied_comment->order_id,
                'cart_id' => $replied_comment->cart_id,
                'comment' => $request->reply,
                'parent_id' => $replied_comment->id,
                'status' => CommentStatusEnum::CONFIRMED->value //confirmed
            ]);
        }
        return redirect()->route('comments.confirmed.page');
    }

    public function filterComments($filter_id)
    {
        if ($filter_id ==0) {
            return redirect()->route('comments.confirmed.page');
        }

        $confirmed_comments = [];
        $delete_request_comments = [];
        $cart_items = CartItem::where('food_id', $filter_id)->get();
        
        
        foreach ($cart_items as $cart_item) {
            $cart = Cart::find($cart_item->cart_id);
            $carts[] = $cart;
            foreach ($cart->comments as $comment) {
                if ($comment->status == CommentStatusEnum::CONFIRMED->value && $comment->parent_id == null) {
                    $confirmed_comments[] = [
                        'id' => $comment->id,
                        'user' => User::find($comment->user_id)->name,
                        'comment' => $comment->comment,
                        'reply' => Comment::where('restaurant_id', Auth::user()->restaurant->id)->where('parent_id', $comment->id)->first()
                    ];
                }
                elseif ($comment->status == CommentStatusEnum::DELETE_REQUEST->value) {
                    $delete_request_comments[] = [
                        'id' => $comment->id,
                        'user' => User::find($comment->user_id)->name,
                        'comment' => $comment->comment
                    ];
                }
            }

        }
        // dd($carts,$cart_items,$delete_request_comments);
        return view('restaurant_owner.comments', [
            'confirmed_comments' => array_reverse($confirmed_comments),
            'delete_request_comments' => array_reverse($delete_request_comments),
            'restaurant_foods' => Auth::user()->restaurant->foods,
            'replied_comment' => ''
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Enums\CommentStatusEnum;

class CommentController extends Controller
{
    public function index()
    {
        $confirmedComments = Comment::whereStatus(CommentStatusEnum::CONFIRMED->value)->get();

        return view('admin.comments',[
            'comments' => $confirmedComments,
        ]);
    }

    public function confirmDelete($comment_id)
    {
        try {
            Comment::find($comment_id)->delete();
        } catch (\Throwable $th) {
            
        }
        return redirect()->route('comments.admin');
    }

    public function declineDelete($comment_id)
    {
        try {
            Comment::where('id',$comment_id)->update(['status'=> CommentStatusEnum::CONFIRMED->value]);
        }catch (\Throwable $th) {
            
        }
        return redirect()->route('comments.admin');
    }


}

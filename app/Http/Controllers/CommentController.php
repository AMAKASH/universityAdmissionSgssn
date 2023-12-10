<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function add_comment()
    {
        request()->validate([
            'comment' => ['string', 'required'],
            'blog_id' => ['numeric', 'required'],
            'comment_id' => ['numeric', 'required'],
        ]);

        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->content = request('comment');
        $comment->blog_id = request('blog_id');
        $comment->reply_to = request('comment_id');

        $comment->save();
        return back();
    }

    public function delete_comment(Comment $comment)
    {
        if ($comment->user_id != auth()->user()->id) {
            abort(403, "Your permission to complete this task is restricted");
        }

        $comment->delete();
        return back();
    }
}

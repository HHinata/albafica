<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * 用于获得评论列表
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $key = $request->input('id');
        $class = $request->input('type');

        $object = $class::with('comments')->with('comments.user')
            ->where('id', $key)->first();
        return $object->comments;
    }

    /**
     * 用于评论操作
     *
     * @param Request $request
     * @return Comment
     */
    public function store(Request $request)
    {
        $class = $request->input('type');
        $key = $request->input('id');

        $post = $class::find($key);

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->user_id = Auth::user()->id;
        $comment->save();

        $post->comments()->save($comment);
        $comment->user = User::find($comment->user_id);
        return $comment;
    }
}

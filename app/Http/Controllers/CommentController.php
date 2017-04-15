<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $class = $request->input('type');
        $key = $request->input('id');
        $object = $class::with('comments')->with('comments.user')->where('id', $key)->first();
        return $object->comments;
    }

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
        $comment->user = $comment->user()->first();
        return $comment;
    }
}

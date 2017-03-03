<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->input('type');
        $id = $request->input('id');
        return Comment::where('target_type', $type)->where('target_id', $id)->with('User')->get();
    }

    public function store(Request $request)
    {
        $comment = new Comment();
        $comment->target_type = $request->input('type');
        $comment->target_id = $request->input('id');
        $comment->content = $request->input('content');
        $comment->user_id = Auth::user()->id;
        $comment->save();
        
        $comment->user = Auth::user();
        return $comment;
    }
}

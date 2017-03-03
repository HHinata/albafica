<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        return Post::where("private", 0)->paginate(20, ['id', 'title', 'content']);
    }

    public function show(Request $request)
    {
        return Post::find($request->input('id'));
    }

    public function detail(Request $request)
    {
        return Post::find($request->input('id'));
    }

    public function rack()
    {
        return Post::paginate(20, ['id', 'title']);
    }

    public function store(Request $request)
    {
        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->private = $request->input('private');
        $post->user_id = Auth::user()->id;
        return [$post->save()];
    }

    public function update(Request $request)
    {
        $post = Post::find($request->input('id'));
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->private = $request->input('private');
        return [$post->save()];
    }
}

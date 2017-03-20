<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        return Post::withCount(['users'=>function($query){
            $uid = Auth::user()?Auth::user()->id:0;
            $query->where('user_id', $uid);
        }])->where("private", 0)->with('user')->with('tags')->paginate(20);
    }

    public function show(Request $request)
    {
        $id = $request->input('id');
        $post = Post::with('tags')->find($id)->toArray();
        $post['tags'] = array_column($post['tags'], 'id');
        return $post;
    }

    public function detail(Request $request)
    {
        return Post::withCount(['users'=>function($query){
            $uid = Auth::user()?Auth::user()->id:0;
            $query->where('user_id', $uid);
        }])->with('user')->with('tags')->find($request->input('id'));
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

        if ($post->save())
        {
            $tags = $request->input('tags');
            foreach ($tags as &$tag)
            {
                if (is_string($tag))
                {
                    $tagObj = new Tag();
                    $tagObj->name = $tag;
                    $tagObj->save();
                    $tag = $tagObj->id;
                }
            }
            $post->tags()->sync($tags);
        }

        return $post->id;
    }

    public function update(Request $request)
    {
        $post = Post::find($request->input('id'));
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->private = $request->input('private');

        if ($post->save())
        {
            $tags = $request->input('tags');
            foreach ($tags as &$tag)
            {
                if (is_string($tag))
                {
                    $tagObj = new Tag();
                    $tagObj->name = $tag;
                    $tagObj->save();
                    $tag = $tagObj->id;
                }
            }
            $post->tags()->sync($tags);
        }

        return $post->id;
    }

    public function star(Request $request)
    {
        if (Auth::user())
        {
            $uid = Auth::user()->id;
            $post = Post::has('users')->find($request->input('id'));
            if ($post)  Post::find($request->input('id'))->users()->detach($uid);
            else    Post::find($request->input('id'))->users()->sync([$uid]);
            return $post;
        }
    }
}

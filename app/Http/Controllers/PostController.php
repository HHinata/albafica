<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * 首页博客板块信息
     *
     * @return mixed
     */
    public function index()
    {
        return Post::withCount(['users'=>function($query){
            $uid = Auth::user()?Auth::user()->id:0;
            $query->where('user_id', $uid);
        }])->where("private", 0)->with('user')->with('tags')->paginate(20);
    }

    /**
     * 首页博客详情模块
     *
     * @param Request $request
     * @return mixed
     */
    public function show(Request $request)
    {
        $id = $request->input('id');
        $user = Auth::user();
        $query = Post::with('tags');

        if ($user->hasRole('admin') == false)
        {
            $query = $query->where('user_id', $user->id);
        }
        $result = $query->find($id);

        if ($result == null)    return response('',404);
        else
        {
            $result = $result->toArray();
            $result['tags'] = array_column($result['tags'], 'id');
            return $result;
        }
    }

    /**
     * 后台博客详情
     *
     * @param Request $request
     * @return mixed
     */
    public function detail(Request $request)
    {
        $id = $request->input('id');
        $query = Post::withCount(['users'=>function($query){
            $uid = Auth::user()?Auth::user()->id:0;
            $query->where('user_id', $uid);
        }]);
        $result = $query->with(['user', 'tags', 'comments', 'comments.user'])->find($id);

        if ($result == null)
        {
            return response('',404);
        }
        return $result;
    }

    /**
     * 后台博客列表页
     *
     * @return mixed
     */
    public function rack()
    {
        $user = Auth::user();

        if ($user->hasRole('admin') == false)
        {
            return Post::where('user_id', $user->id)->paginate(20, ['id', 'title']);
        }

        return Post::paginate(20, ['id', 'title']);
    }

    /**
     * 动态获得博客搜索信息
     *
     * @param Request $request
     * @return mixed
     */
    public function seek(Request $request)
    {
        $query = $request->input('query');
        $postList = Post::where('title', 'like', "%$query%")->get(['id', 'title'])->toArray();
        array_walk($postList, function(&$value){
            $value['value'] = $value['title'];
        });
        return $postList;
    }

    /**
     * 添加新文章
     *
     * @param Request $request
     * @return mixed
     */
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

    /**
     * 更新文章信息
     *
     * @param Request $request
     * @return mixed
     */
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


    /**
     * 用户收藏文章操作
     *
     * @param Request $request
     * @return mixed
     */
    public function star(Request $request)
    {
        if (Auth::user())
        {
            $uid = Auth::user()->id;
            $post = Post::has('users')->find($request->input('id'));

            if ($post)  Post::find($request->input('id'))->users()->detach($uid);
            else        Post::find($request->input('id'))->users()->sync([$uid]);
            return $post;
        }
    }

    /**
     * 文章评论功能
     *
     * @param Request $request
     * @return Comment
     */
    public function comment(Request $request)
    {
        $post = Post::find($request->input('id'));
        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->user_id = Auth::user()->id;
        $comment->save();
        $post->comments()->save($comment);
        $comment->user = $comment->user()->first();
        return $comment;
    }


    /**
     * 得到文章评论信息
     *
     * @param Request $request
     * @return mixed
     */
    public function speech(Request $request)
    {
        return Post::with("comments", 'comments.user')->find($request->input('id'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index()
    {
        return Notice::with(['post', 'post.user'])->where('publish_time', '<', time())->orderBy('created_at', 'desc')->get();
    }

    public function rack()
    {
        return Notice::with('post')->paginate(20, ['id', 'post_id']);
    }

    public function store(Request $request)
    {
        $notice = new Notice();
        $notice->post_id = $request->input('post_id')['id'];
        $notice->publish_time = strtotime($request->input('publish_time'));
        $notice->save();
        return $notice->id;
    }
}

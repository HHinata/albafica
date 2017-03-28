<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function index()
    {
        return Team::paginate(20, ['id', 'name', 'avatar', 'desc']);
    }

    public function rack()
    {
        $user = Auth::user();

        if ($user->hasRole('admin') == false)
        {
            return Team::whereHas('users', function($query)use($user){
                $query->where('user_id', $user->id)->where('role', 1);
            })->paginate(20, ['id', 'name', 'avatar', 'desc']);
        }
        return Team::paginate(20, ['id', 'name', 'avatar', 'desc']);
    }

    public function store(Request $request)
    {
        $team = new Team();

        $team->name = $request->input('name');
        $team->desc = $request->input('desc');

        if ($team->save())
        {
            $team->users()->sync([['user_id'=>Auth::user()->id, 'role'=>1]]);
        }

        return $team->id;
    }

    public function detail(Request $request)
    {
        $id = $request->input('id');
        $query = Team::with(["users", "contests", "comments"]);
        return$query->find($id);
    }

    public function show(Request $request)
    {
        $id = $request->input('id');
        $user = Auth::user();
        $query = Team::with(["users", "contests", "comments"]);

        if ($user->hasRole('admin') == false)
        {
            $query = $query->whereHas('users', function($query)use($user){
                $query->where('user_id', $user->id)->where('role', 1);
            });
        }
        $result = $query->find($id);

        if ($result == null)    return response('',404);
        else    return $result;
    }

    public function apply(Request $request)
    {
        $id = $request->input('id');
        $user = Auth::user();
        $team = Team::find($id);
        $team->users()->sync([$user->id=>['role' => 0]]);
        return [true];
    }

    public function seek(Request $request)
    {
        $query = $request->input('query');
        $teamList = Team::where('name', 'like', "%$query%")->get(['id', 'name'])->toArray();
        array_walk($teamList, function(&$value){
            $value['value'] = $value['name'];
        });
        return $teamList;
    }

    public function comment(Request $request)
    {
        $team = Team::find($request->input('id'));
        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->user_id = Auth::user()->id;
        $comment->save();
        $team->comments()->save($comment);
        return $comment;
    }
}

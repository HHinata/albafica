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

    /**
     * 后台列表页
     *
     * @return mixed
     */
    public function rack()
    {
        $user = Auth::user();

        if ($user->hasRole('admin') == false)
        {
            $query = Team::whereHas('users', function($query)use($user){
                $query->where('user_id', $user->id)->where('role', 1);
            });
            return $query->paginate(20, ['id', 'name', 'avatar', 'desc']);
        }
        else    return Team::paginate(20, ['id', 'name', 'avatar', 'desc']);
    }

    /**
     * 新建团队操作
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|mixed|\Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request)
    {
        $team = new Team();
        $user = Auth::user();
        $team->name = $request->input('name');
        $team->desc = $request->input('desc');
        $team->avatar = $request->input('avatar');

        if ($team->save())
        {
            $team->users()->attach($user->id, ['role'=>1]);
            return $team->id;
        }
        else    return response('', 404);
    }

    /**
     * 团队前台详情页
     *
     * @param Request $request
     * @return mixed
     */
    public function detail(Request $request)
    {
        $user = Auth::user();
        $id = $request->input('id');
        $query = Team::with(["users", "contests", "comments", "comments.user"]);
        $team = $query->find($id);
        $team->inTeam = $user?$team->userRole($user->id):-1;
        return $team;
    }

    /**
     * 团队信息更新
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function update(Request $request)
    {
        $id = $request->input('id');
        $team = Team::find($id);
        $team->desc = $request->input('desc');
        $team->avatar = $request->input('avatar');

        if ($team->save())
        {
            return $team->id;
        }
        else    return response('', 404);
    }

    /**
     * 后台团队详情页
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|mixed|\Symfony\Component\HttpFoundation\Response
     */
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

    /**
     * 团队申请加入功能
     *
     * @param Request $request
     * @return array
     */
    public function apply(Request $request)
    {
        $user = Auth::user();
        if ($user == null)  return response('', 404);
        $id = $request->input('id');
        $team = Team::find($id);
        if ($team->userRole($user->id) == -1)
        {
            $team->users()->attach($user->id, ['role' => 0]);
        }
        return $team->id;
    }

    /**
     * 团队远程搜索功能，主要用于比赛团队限制
     *
     * @param Request $request
     * @return mixed
     */
    public function seek(Request $request)
    {
        $query = $request->input('query');
        $teamList = Team::where('name', 'like', "%$query%")->get(['id', 'name'])->toArray();

        array_walk($teamList, function(&$value){
            $value['value'] = $value['name'];
        });
        return $teamList;
    }

    /**
     * 团队评论功能
     *
     * @param Request $request
     * @return Comment
     */
    public function comment(Request $request)
    {
        $user = Auth::user();
        if ($user == null)  return response('', 404);

        $id = $request->input('id');
        $team = Team::find($id);

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->user_id = $user->id;
        $comment->save();

        $team->comments()->save($comment);
        $comment->user = $comment->user()->first();
        return $comment;
    }

    /**
     * 切换用户角色
     *
     * @param Request $request
     */
    public function switchRole(Request $request)
    {
        $user = Auth::user();
        $id = $request->input('id');
        $uid = $request->input('uid');

        $team = Team::find($id);
        if ($team->userRole($user->id) != 1 || $uid == $user->id)  return response('', 404);

        if ($team->userRole($uid) == 0) return $team->users()->updateExistingPivot($uid, ['role'=>2]);
        else    $team->users()->detach($uid);
    }

    public function verify(Request $request){
        $id = $request->input('id');
        $team = Team::find($id);
        $user = Auth::user();

        if (is_null($user)) return response('',404);
        if ($user->hasRole('admin') === false){
            $user = $team->users()->where('user_id', $user->id)->get();
            if ($user->isEmpty())   return response('',404);
        }
        return response('', 200);
    }
}

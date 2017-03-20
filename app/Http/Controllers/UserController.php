<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Solution;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function rank()
    {
        return User::orderBy("rating", "desc")->paginate(20);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $user->avatar = $request->input('avatar');
        $user->birthday = strtotime($request->input('birthday'));
        $user->city = $request->input('city');
        $user->sex = $request->input('sex');
        $user->info = $request->input('info');
        $user->avatar = $request->input('avatar');
        $user->save();
        return $user->id;
    }

    public function info(Request $request)
    {
        $user = User::withCount(['followers'=>function($query)use($request){
            $uid = Auth::user()?Auth::user()->id:0;
            $query->where('user_id', $uid);
        }])->with(['posts', 'problems', 'followers', 'followings', 'solution', 'teams'])->where('name', $request->input('name', Auth::user()->name))->first();

        $user->solved = Solution::where('user_id', $user->id)->where('result', 1)->count();
        $user->submited = Solution::where('user_id', $user->id)->count();
        $user->posted = Post::where('user_id', $user->id)->count();

        return $user;
    }

    public function star(Request $request)
    {
        if (Auth::user())
        {
            $uid = Auth::user()->id;
            $user = User::has('followers')->find($request->input('id'));
            if ($user)  User::find($request->input('id'))->followers()->detach($uid);
            else    User::find($request->input('id'))->followers()->sync([$uid]);
            return $user;
        }
    }
}

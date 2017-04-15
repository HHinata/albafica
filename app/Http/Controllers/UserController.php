<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Solution;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function rank(Request $request)
    {
        $page = $request->input('page_count', 20);
        return User::orderBy("rating", "desc")->paginate($page);
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

    /**
     * 获取用户信息
     *
     * @param Request $request
     * @return mixed
     */
    public function info(Request $request)
    {
        $user = Auth::user();
        $name = $request->input('name', null);
        if ($name == null && $user!=null)   $name = $user->name;
        $fields = ['posts', 'problems', 'followers', 'followings', 'solution', 'teams'];

        $user = User::withCount(['followers'=>
            function($query)use($request){
                $uid = Auth::user()?Auth::user()->id:0;
                $query->where('user_id', $uid);
        }])->with($fields)->where('name', $name)->first();

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

    public function role()
    {
        return User::with("roles")->paginate(20);
    }
}

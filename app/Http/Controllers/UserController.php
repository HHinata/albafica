<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function rank()
    {
        return User::orderBy("rating")->paginate(20);
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
        return [$user->save()];
    }
}

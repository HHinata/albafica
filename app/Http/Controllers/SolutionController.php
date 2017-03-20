<?php

namespace App\Http\Controllers;

use App\Models\Solution;
use App\User;
use Illuminate\Http\Request;

class SolutionController extends Controller
{
    public function index(Request $request)
    {
        $cid = $request->input('cid', 0);
        return Solution::with(['user', 'problem'])->where("contest_id", $cid)->orderBy("id", "desc")->paginate(20);
    }

    public function detail(Request $request)
    {
        $id = $request->input('id');
        return Solution::with('user')->find($id);
    }

    /**
     * 传入key和id，来触发结果
     * @param Request $request
     */
    public function callback(Request $request)
    {
        $key = $request->input('key', null);
        $id = $request->input('id', '');

        if (($key == 'KEY' && $id !== null) || true)
        {
            $solution = Solution::find($request->input('id'));
            if ($solution->result === 1)
            {
                $user = User::find($solution->user_id);
                $user->rating += $solution->problem_id;
                $user->save();
            }
        }
    }
}

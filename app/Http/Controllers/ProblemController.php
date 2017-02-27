<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use App\Models\Solution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProblemController extends Controller
{
    public function index()
    {
        return Problem::where("private", 0)->paginate(20, ['id', 'title', 'solved', 'submited']);
    }

    public function detail(Request $request)
    {
        $id = $request->input('id');
        return Problem::find($id);
    }

    public function submit(Request $request)
    {
        //TODO:题目的提交功能
        $solution = new Solution();

        $solution->user_id = 1;
        $solution->platform = 'hdu';
        $solution->sign = "123";
        $solution->lang = 1;
        $solution->problem_id = $request->input('id');
        $solution->code = $request->input('code');

        return  [$solution->save()];
    }
}

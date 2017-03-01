<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use App\Models\Solution;
use Illuminate\Http\Request;

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

    public function crawler(Request $request)
    {
        $platform = $request->input('plat');
        $sign = $request->input('sign');

        $problem = app()->make(strtoupper($platform))->grabProblem($sign);
        $problem['platform'] = $platform;
        $problem['sign'] = $sign;

        return $problem;
    }

    public function store(Request $request)
    {
        $problem = new Problem();

        $problem->platform = $request->input('platform');
        $problem->sign = $request->input('sign');

        $problem->title = $request->input('title');
        $problem->desc = $request->input('description');
        $problem->input = $request->input('input');
        $problem->output = $request->input('output');

        $problem->sample_input = $request->input('sample_input');
        $problem->sample_output = $request->input('sample_output');

        $problem->time_limit = $request->input('time_limit');
        $problem->mem_limit = $request->input('mem_limit');

        return [$problem->save()];
    }
}

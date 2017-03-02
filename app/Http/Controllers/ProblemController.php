<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use App\Models\Solution;
use Illuminate\Http\Request;

class ProblemController extends Controller
{

    /**
     * 首页题目列表
     *
     * @return mixed
     */
    public function index()
    {
        return Problem::where("private", 0)->paginate(20, ['id', 'title', 'solved', 'submited']);
    }

    /**
     * 题目详情
     *
     * @param Request $request
     * @return mixed
     */
    public function detail(Request $request)
    {
        $id = $request->input('id');
        return Problem::find($id);
    }

    /**
     * 提交代码功能
     *
     * @param Request $request
     * @return array
     */
    public function submit(Request $request)
    {
        //TODO:题目的提交功能
        $solution = new Solution();

        $solution->user_id = Auth::user()->id;
        $solution->lang = $request->input('lang');
        $solution->problem_id = $request->input('id');
        $solution->code = $request->input('code');

        $problem = Problem::find($solution->problem_id);
        $solution->platform = $problem->platform;
        $solution->sign = $problem->sign;

        return  [$solution->save()];
    }

    /**
     * 爬取其他OJ的题目信息
     *
     * @param Request $request
     * @return mixed
     */
    public function crawler(Request $request)
    {
        $platform = $request->input('plat');
        $sign = $request->input('sign');

        $problem = app()->make(strtoupper($platform))->grabProblem($sign);
        $problem['platform'] = $platform;
        $problem['sign'] = $sign;

        return $problem;
    }

    /**
     * 新增题目
     *
     * @param Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $problem = new Problem();

        $problem->platform = $request->input('platform');
        $problem->sign = $request->input('sign');

        $problem->title = $request->input('title');
        $problem->desc = $request->input('desc');
        $problem->input = $request->input('input');
        $problem->output = $request->input('output');

        $problem->sample_input = $request->input('sample_input');
        $problem->sample_output = $request->input('sample_output');

        $problem->time_limit = $request->input('time_limit');
        $problem->mem_limit = $request->input('mem_limit');

        return [$problem->save()];
    }

    public function update(Request $request)
    {
        $problem = Problem::find($request->input('id'));

        $problem->platform = $request->input('platform');
        $problem->sign = $request->input('sign');

        $problem->title = $request->input('title');
        $problem->desc = $request->input('desc');
        $problem->input = $request->input('input');
        $problem->output = $request->input('output');

        $problem->sample_input = $request->input('sample_input');
        $problem->sample_output = $request->input('sample_output');

        $problem->time_limit = $request->input('time_limit');
        $problem->mem_limit = $request->input('mem_limit');

        return [$problem->save()];
    }

    /**
     * 用于快速搜索题目
     *
     * @param Request $request
     */
    public function seek(Request $request)
    {
        $query = $request->input('query');
        $problemList = Problem::where('title', 'like', "%$query%")->get(['id', 'title'])->toArray();
        array_walk($problemList, function(&$value){
           $value['value'] = $value['title'];
        });
        return $problemList;
    }


    public function show(Request $request)
    {
        $id = $request->input('id');
        return Problem::find($id);
    }
}

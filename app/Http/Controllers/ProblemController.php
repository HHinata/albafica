<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use App\Models\Solution;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProblemController extends Controller
{

    /**
     * 首页题目列表
     *
     * @return mixed
     */
    public function index()
    {
        return Problem::where("private", 0)->with('tags')->paginate(20, ['id', 'title', 'solved', 'submited']);
    }

    public function rack()
    {
        return Problem::paginate(20, ['id', 'title', 'solved', 'submited']);
    }

    /**
     * 题目详情
     *
     * @param Request $request
     * @return mixed
     */
    public function detail(Request $request)
    {
        return Problem::withCount(['users'=>function($query){
            $uid = Auth::user()?Auth::user()->id:0;
            $query->where('user_id', $uid);
        }])->find($request->input('id'));
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
        $problem->desc = $request->input('description');
        $problem->input = $request->input('input');
        $problem->output = $request->input('output');

        $problem->sample_input = $request->input('sample_input');
        $problem->sample_output = $request->input('sample_output');

        $problem->time_limit = $request->input('time_limit');
        $problem->mem_limit = $request->input('mem_limit');

        if ($problem->save())
        {
            $tags = $request->input('tags');
            foreach ($tags as &$tag)
            {
                if (is_string($tag))
                {
                    $tagObj = new Tag();
                    $tagObj->name = $tag;
                    $tagObj->save();
                    $tag = $tagObj->id;
                }
            }
            $problem->tags()->sync($tags);
        }

        return $problem->id;
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

        if ($problem->save())
        {
            $tags = $request->input('tags');
            foreach ($tags as &$tag)
            {
                if (is_string($tag))
                {
                    $tagObj = new Tag();
                    $tagObj->name = $tag;
                    $tagObj->save();
                    $tag = $tagObj->id;
                }
            }
            $problem->tags()->sync($tags);
        }

        return $problem->id;
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
        $problem = Problem::with('tags')->find($id)->toArray();
        $problem['tags'] = array_column($problem['tags'], 'id');
        return $problem;
    }

    public function star(Request $request)
    {
        if (Auth::user())
        {
            $uid = Auth::user()->id;
            $problem = Problem::has('users')->find($request->input('id'));
            if ($problem)  Problem::find($request->input('id'))->users()->detach($uid);
            else    Problem::find($request->input('id'))->users()->sync([$uid]);
            return $problem;
        }
    }

}

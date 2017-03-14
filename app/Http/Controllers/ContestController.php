<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\Problem;
use App\Models\Solution;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContestController extends Controller
{
    /**
     * 首页比赛列表
     * @return mixed
     */
    public function index()
    {
        return Contest::where("private", 0)->paginate(20, ['id', 'title', 'start_time', 'end_time']);
    }

    public function rack()
    {
        return Contest::paginate(20, ['id', 'title', 'start_time', 'end_time']);
    }

    /**
     * 新增比赛
     */
    public function store(Request $request)
    {
        $contest = new Contest();
        $contest->desc = $request->input('description');
        $contest->title = $request->input('title');
        $contest->private = $request->input('private');

        $timeRange = $request->input('time');
        $contest->start_time = strtotime($timeRange[0]);
        $contest->end_time = strtotime($timeRange[1]);

        if ($contest->save())
        {
            $problemData = [];
            $problemList = $request->input('problems');
            foreach ($problemList as $key=>$problem)
            {
                $item['order'] = $key;
                if (isset($problem['alias']))   $item['alias'] = $problem['alias'];
                $problemData[$problem['id']] = $item;
            }
            $contest->problems()->sync($problemData);
        }
        return $contest->id;
    }

    /**
     * 更新比赛
     */
    public function update(Request $request)
    {
        $contest = Contest::find($request->input('id'));
        $contest->desc = $request->input('desc');
        $contest->title = $request->input('title');
        $contest->private = $request->input('private');

        $timeRange = $request->input('time');
        $contest->start_time = strtotime($timeRange[0]);
        $contest->end_time = strtotime($timeRange[1]);

        if ($contest->save())
        {
            $problemData = [];
            $problemList = $request->input('problems');
            foreach ($problemList as $key=>$problem)
            {
                $item['order'] = $key;
                if (isset($problem['alias']))   $item['alias'] = $problem['alias'];
                $problemData[$problem['id']] = $item;
            }
            $contest->problems()->sync($problemData);
        }
        return $contest->id;
    }

    /**
     * 首页比赛详情
     *
     * @param Request $request
     * @return mixed
     */
    public function detail(Request $request)
    {
       $id = $request->input('id');
       $contest = Contest::with('problems')->find($id);
       // 联表得到所有的问题信息,包括id,标题
       return $contest;
    }

    /**
     * 获得比赛的题目列表
     *
     * @param Request $request
     * @return mixed
     */
    public function problem(Request $request)
    {
        $id = $request->input('id');
        $cid = $request->input('cid');
        $problem = Contest::find($cid)->problems()->wherePivot('order', $id)->first()->toArray();
        return $problem;
    }

    public function rank(Request $request)
    {
        //TODO: 比赛的rank榜
        $rank = [];
        $contestId = $request->input('id');

        $solutions = Solution::with('user')->where('contest_id', $contestId)->where('result', '>', 0)->orderBy('result')->get()->toArray();

        $contest = Contest::find($contestId);
        $problems = $contest->problems;
        $users = array_column($solutions, 'user');
        foreach ($users as $user)
        {
            $rank[$user['id']] = ['time'=>0, 'name'=>$user['name']];
            foreach ($problems as $problem)
            {
                $rank[$user['id']]['info'][$problem['id']] = ['submited'=>0, 'solved'=>0];
            }
        }

        foreach ($solutions as $solution)
        {
            if ($solution['result'] === 1)
            {
                $rank[$solution['user_id']]['time'] = intval((strtotime($solution['created_at']) - $contest['start_time'])/60);
                $rank[$solution['user_id']]['info'][$solution['problem_id']]['solved'] = 1;
            }
            else
            {
                if ($rank[$solution['user_id']]['time'])    $rank[$solution['user_id']]['time'] += 20;
                $rank[$solution['user_id']]['info'][$solution['problem_id']]['submited'] += 1;
            }
        }

        return ['problems'=>$problems, 'rank'=>$rank];
    }

    public function submit(Request $request)
    {
        //TODO: 比赛的提交功能
        $solution = new Solution();
        $solution->user_id = Auth::user()->id;
        $solution->lang = $request->input('lang');
        $solution->contest_id = $request->input('cid');
        $solution->code = $request->input('code');

        $order = $request->input('pid');
        $problem = Contest::find($solution->contest_id)->problems()->wherePivot('order', $order)->first();

        $solution->problem_id = $problem->id;
        $solution->platform = $problem->platform;
        $solution->sign = $problem->sign;
        $solution->save();

        return $solution->id;
    }

    public function show(Request $request)
    {
        $id = $request->input('id');
        $contest = Contest::with('problems')->find($id);
        $contest['time'] = [date("Y-m-d\TH:i:s\Z", $contest['start_time']), date("Y-m-d\TH:i:s\Z", $contest['end_time'])];
        // 联表得到所有的问题信息,包括id,标题
        return $contest;
    }

}

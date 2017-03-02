<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\ContestProblem;
use App\Models\Problem;
use Illuminate\Http\Request;

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
            $problemList = $request->input('problems');
            foreach ($problemList as $key=>$problem)
            {
                $data['order'] = $key;
                if (isset($problem['alias']))
                    $data['alias'] = $problem['alias'];
                $data['problem_id'] = $problem['id'];
                $data['contest_id'] = $contest->id;
                ContestProblem::updateOrCreate(['contest_id'=>$contest->id, 'order'=>$key], $data);
            }
            ContestProblem::where('contest_id', $contest->id)->where('order', '>', count($problemList))->delete();
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
            $problemList = $request->input('problems');
            foreach ($problemList as $key=>$problem)
            {
                $data['order'] = $key;
                if (isset($problem['alias']))
                    $data['alias'] = $problem['alias'];
                $data['problem_id'] = $problem['id'];
                $data['contest_id'] = $contest->id;
                ContestProblem::updateOrCreate(['contest_id'=>$contest->id, 'order'=>$key], $data);
            }
            ContestProblem::where('contest_id', $contest->id)->where('order', '>=', count($problemList))->delete();
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
       $problemList = ContestProblem::where('contest_id', $id)->orderBy('order')->with('Problem')->get()->toArray();
       $contest = Contest::find($id)->toArray();

       array_walk($problemList, function (&$value){
            $value['problem']['order'] = $value['order'];
            $value = $value['problem'];
       });
       $contest['problem_list'] = $problemList;
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
        $problem = ContestProblem::where('contest_id', $cid)->where('order', $id)->with('Problem')->first()->toArray();
        return $problem['problem'];
    }

    public function rank(Request $request)
    {
        //TODO: 比赛的rank榜
    }

    public function submit(Request $request)
    {
        //TODO: 比赛的提交功能
        $solution = new Solution();
        $solution->user_id = Auth::user()->id;
        $solution->lang = $request->input('lang');
        $solution->contest_id = $request->input('contest_id');
        $solution->code = $request->input('code');

        $order = $request->input('id');
        $contestProblem = ContestProblem::where('contest_id', $solution->contest_id)->where('order', $order)->first();

        $solution->problem_id = $contestProblem->problem_id;

        $problem = Problem::find($solution->problem_id);
        $solution->platform = $problem->platform;
        $solution->sign = $problem->sign;

        return  [$solution->save()];
    }

    public function show(Request $request)
    {
        $id = $request->input('id');
        $problemList = ContestProblem::where('contest_id', $id)->orderBy('order')->with('Problem')->get()->toArray();
        $contest = Contest::find($id)->toArray();

        array_walk($problemList, function (&$value){
            $value['problem']['order'] = $value['order'];
            $value['problem']['alias'] = $value['alias'];
            $value = $value['problem'];
        });
        $contest['problems'] = $problemList;
        $contest['time'] = [date("Y-m-d\TH:i:s\Z", $contest['start_time']), date("Y-m-d\TH:i:s\Z", $contest['end_time'])];
        // 联表得到所有的问题信息,包括id,标题
        return $contest;
    }

}

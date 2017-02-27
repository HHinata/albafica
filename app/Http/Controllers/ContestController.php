<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\ContestProblem;
use Illuminate\Http\Request;

class ContestController extends Controller
{
    public function index()
    {
        return Contest::where("private", 0)->paginate(20, ['id', 'title', 'start_time', 'end_time']);
    }

    public function detail(Request $request)
    {
       $id = $request->input('id');
       $problemList = ContestProblem::where('contest_id', $id)->with('Problem')->get()->toArray();
       $contest = Contest::find($id)->toArray();

       array_walk($problemList, function (&$value){
            $value['problem']['order'] = $value['order'];
            $value = $value['problem'];
       });
       $contest['problem_list'] = $problemList;
       // 联表得到所有的问题信息,包括id,标题
       return $contest;
    }

    public function rank(Request $request)
    {
        //TODO: 比赛的rank榜
    }

    public function submit(Request $request)
    {
        //TODO: 比赛的提交功能
        $solution = new Solution();

        $solution->user_id = 1;
        $solution->platform = 'hdu';
        $solution->sign = "123";
        $solution->lang = 1;
        $solution->problem_id = $request->input('id');
        $solution->contest_id = $request->input('contest_id');
        $solution->code = $request->input('code');

        return  [$solution->save()];
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\ContestProblem;
use App\Models\Problem;
use Illuminate\Http\Request;

class ContestController extends Controller
{
    /**
     * @return Response
     */
    public function index(Request $request)
    {
        $contests = Contest::all();
        foreach ($contests as $contest)
        {
            $contest['start_time'] = date('Y/m/d H:i', $contest['start_time']);
            $contest['end_time'] = date('Y/m/d H:i', $contest['end_time']);
        }
        return $contests;
    }

    /**
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

    }

    /**
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $contest = Contest::where('id', $id)->first();
        $contest['start_time'] = date('Y/m/d H:i', $contest['start_time']);
        $contest['end_time'] = date('Y/m/d H:i', $contest['end_time']);

        $problemList = ContestProblem::where('contest_id', $id)->get(['problem_id'])->toArray();
        $contest['problem_list'] = implode(',', array_column($problemList, 'problem_id'));
        return $contest;
    }

    /**
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = $request->all();
        $data['start_time'] = strtotime($data['start_time']);
        $data['end_time'] = strtotime($data['end_time']);

        $problemList = explode(',', $data['problem_list']);
        unset($data['problem_list']);

        if (count($problemList) == Problem::find($problemList)->count())
        {
            $contestProblem = new ContestProblem();
            $contestProblem::where('contest_id', $id)->delete();

            foreach ($problemList as $pid)
            {
                ContestProblem::create(['contest_id'=>$id, 'problem_id'=>$pid]);
            }
        }

        $contest = new Contest();
        $contest::where('id', $id)
            ->update($data);

        return Problem::find($problemList)->count();
    }

    /**
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function detail(Request $request, $id)
    {
        $contest = Contest::where('id', $id)->first()->toArray();
        $problemList = ContestProblem::where('contest_id', $id)->get(['problem_id']);
        foreach ($problemList as $p)
        {
            $contest['problems'][] = Problem::where('id', $p['problem_id'])->first();
        }
        return $contest;
    }
}

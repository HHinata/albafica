<?php

namespace App\Http\Controllers\Contest;

use App\Models\Contest;
use App\Models\ContestProblem;
use App\Models\Problem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
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
        $query = $request->all();
        $query['start_time'] = strtotime($query['start_time']);
        $query['end_time'] = strtotime($query['end_time']);

        $problemList = explode(',', $query['problem_list']);
        unset($query['problem_list']);

        $contest = new Contest($query);
        $contest->save();

        if (count($problemList) == Problem::find($problemList)->count())
        {
            foreach ($problemList as $order=>$pid)
            {
                ContestProblem::updateOrCreate(['order'=>$order, 'contest_id'=>$contest->id], ['contest_id'=>$contest->id, 'problem_id'=>$pid, 'order'=>$order]);
            }
        }

        return Problem::find($problemList)->count();
    }

    /**
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $contest = Contest::where('id', $id)->first();

        $problemSet = Contest::find($id)->problems;
        $contest['problemset'] = $problemSet;
        $contest['start_time'] = date('d/m/Y h:i:s', $contest['start_time']);
        $contest['end_time'] = date('d/m/Y h:i:s', $contest['end_time']);

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
        $data = $request->all();
        $data['start_time'] = strtotime($data['start_time']);
        $data['end_time'] = strtotime($data['end_time']);

        $problemSet = $data['problemset'];
        $problemIds = array_column($problemSet, 'id');
        unset($data['problemset']);

        if (count($problemSet) == Problem::find($problemIds)->count())
        {
            foreach ($problemSet as $key=>$value)
            {
                ContestProblem::updateOrCreate(['order'=>$key, 'contest_id'=>$id], ['contest_id'=>$id, 'problem_id'=>$value['id'], 'order'=>$key]);
            }
            ContestProblem::where('order', '>=', count($problemSet))->delete();
        }

        Contest::where('id', $id)->update($data);
        return Problem::find($problemIds)->count();
    }

    /**
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}

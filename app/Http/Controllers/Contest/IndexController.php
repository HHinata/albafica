<?php

namespace App\Http\Controllers\Contest;

use App\Models\Contest;
use App\Models\ContestProblem;
use App\Models\Problem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //
    public function list()
    {
        return Contest::all();
    }

    public function detail($id)
    {
        $contest = Contest::where('id', $id)->first()->toArray();
        $problemList = ContestProblem::where('contest_id', $id)->get(['problem_id']);
        foreach ($problemList as $p)
        {
            $contest['problems'][] = Problem::where('id', $p['problem_id'])->first();
        }
        return $contest;
    }

    public function problem($cid, $id)
    {
        $record = ContestProblem::where('contest_id', $cid)->where('order', $id)->first(["problem_id"]);

        return Problem::where('id', $record['problem_id'])->first();
    }
}

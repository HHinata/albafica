<?php

namespace App\Http\Controllers\Solution;

use App\Models\Solution;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * @return Response
     */
    public function inProblem()
    {
        $solutions = Solution::where('contest_id', 0)->get();
        return $solutions;
    }

    public function inContest($id)
    {
        $solutions = Solution::where('contest_id', $id)->get();
        return $solutions;
    }
}

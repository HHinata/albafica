<?php

namespace App\Http\Controllers\Contest;

use App\Contracts\PlatformServiceContract;
use App\Models\Contest;
use App\Models\ContestProblem;
use App\Models\Problem;
use App\Models\Solution;
use Illuminate\Support\Facades\Auth;
use Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /* the platform object for code judge */
    private $plat = null;

    /**
     * Injection A platform objec
     *
     * PlatformController constructor.
     * @param PlatformServiceContract $plat
     */
    public function __construct(PlatformServiceContract $plat)
    {
        $this->plat = $plat;
    }

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

    /**
     * Submit code to Open Judge
     */
    public function submit()
    {
        $pid = Request::input('pid');
        $cid = Request::input('cid');
        $code = Request::input('code');
        $lang = Request::input('lang');

        $pid = ContestProblem::where('contest_id', $cid)->where('order', $pid)->first()->problem_id;

        $problem = Problem::where('id', $pid)->first();

        $rid = $this->plat
            ->setPlatform($problem->platform)
            ->submit($problem->sign, $lang, $code);

        $data = [
            'uid'=>Auth::user()->id,
            'pid'=>$pid,
            'cid'=>$cid,
            'rid'=>$rid,
            'lang'=>0
        ];

        $solution = new Solution();
        $solution->join($data);

        return $rid;
    }

    public function rank($id)
    {
        $solutions = Solution::where('contest_id', $id)->get()->toArray();

        $contestMap = ContestProblem::where('problem_id', '>', 0)->where('contest_id', $id)
            ->get(['order', 'problem_id'])->toArray();

        $contestMap = array_column($contestMap, 'order', 'problem_id');
        $userArray = array_unique(array_column($solutions, 'user_id'), SORT_NUMERIC);
        $rankArray = array_fill_keys($userArray, array_fill(0, count($contestMap), ['up'=>0, 'down'=>0]));

        $statistics = function ($value)use(&$rankArray, $contestMap)
        {
            $order = $contestMap[$value['problem_id']];
            $result = ($value['result'] == 1)?'up':'down';
            $rankArray[$value['user_id']][$order][$result]++;
        };

        array_walk($solutions, $statistics);

        array_walk($rankArray,function (&$value, $key){
            $value = ['user_id'=>$key, 'result'=>$value];
        });

        return $rankArray;
    }
}

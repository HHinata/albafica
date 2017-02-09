<?php

namespace App\Http\Controllers;

use App\Contracts\PlatformServiceContract;
use App\Contracts\ProblemContract;
use App\Models\Problem;
use App\Models\Solution;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Request;

class PlatformController extends Controller
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

    /**
     * Grab problem information from Open Judge
     */
    public function grab()
    {
        $data = Request::all();

        $info = $this->plat
            ->setPlatform($data['platform'])
            ->grabProblem($data['id']);

        return Response::Json($info);
    }

    /**
     * Submit code to Open Judge
     */
    public function submit()
    {
        $pid = Request::input('pid');
        $code = Request::input('code');
        $lang = Request::input('lang');

        $problem = Problem::where('id', $pid)->first();

        $rid = $this->plat
            ->setPlatform($problem->platform)
            ->submit($problem->sign, $lang, $code);

        $data = [
            'uid'=>Auth::user()->id,
            'pid'=>$pid,
            'rid'=>$rid,
            'lang'=>0
        ];

        $solution = new Solution();
        $solution->join($data);

        return $rid;
    }
}

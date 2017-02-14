<?php

namespace App\Http\Controllers\Problem;

use App\Contracts\PlatformServiceContract;
use App\Models\Problem;
use App\Models\Solution;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Request;

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

    /**
     * @return Response
     */
    public function list()
    {
        $problems = Problem::all();
        return $problems;
    }

    public function detail($id)
    {
        $problem = Problem::where('id', $id)->first();
        return $problem;
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

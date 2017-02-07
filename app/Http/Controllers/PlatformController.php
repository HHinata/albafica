<?php

namespace App\Http\Controllers;

use App\Contracts\PlatformServiceContract;
use App\Contracts\ProblemContract;
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

        $content = $this->plat
            ->setPlatform($data['platform'])
            ->grabProblem($data['id']);

        return Response::Json($content);
    }

    /**
     * Submit code to Open Judge
     */
    public function submit()
    {
        $pid = Request::input('pid');
        $code = Request::input('code');
        $lang = Request::input('lang');

        $res = $this->plat
            ->setPlatform('HDU')
            ->submit($pid, $lang, $code);

        return $res;
    }
}

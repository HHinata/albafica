<?php

namespace App\Http\Controllers\Problem;

use App\Contracts\PlatformServiceContract;
use App\Models\Problem;
use Illuminate\Http\Response;
use Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
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
    public function index(Request $request)
    {
        $problems = Problem::all();
        return $problems;
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
        //
        $data = Request::all();

        unset($data['id']);

        $problem = new Problem($data);

        $problem->save();

        return $data;
    }

    /**
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $problem = Problem::where('id', $id)->first();
        return $problem;
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
    }

    /**
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
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

        return $info;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use Request;

class ProblemController extends Controller
{
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
}

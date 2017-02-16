<?php

namespace App\Http\Controllers\Solution;

use App\Models\Solution;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * @return Response
     */
    public function index(Request $request)
    {
        $solutions = Solution::all();
        return $solutions;
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
    }

    /**
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $solution = Solution::where('id', $id)->first();
        return $solution;
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

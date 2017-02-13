<?php

namespace App\Http\Controllers\Problem;

use App\Models\Problem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
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
}

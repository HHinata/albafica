<?php

namespace App\Http\Controllers;

use App\Models\Solution;
use Illuminate\Http\Request;

class SolutionController extends Controller
{
    public function index(Request $request)
    {
        $cid = $request->input('cid', 0);
        return Solution::with(['user', 'problem'])->where("contest_id", $cid)->orderBy("id", "desc")->paginate(20);
    }

    public function detail(Request $request)
    {
        $id = $request->input('id');
        return Solution::find($id);
    }
}

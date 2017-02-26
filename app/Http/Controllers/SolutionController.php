<?php

namespace App\Http\Controllers;

use App\Models\Solution;
use Illuminate\Http\Request;

class SolutionController extends Controller
{
    public function index()
    {
        return Solution::where("contest_id", 0)->orderBy("id", "desc")->paginate(20);
    }
}

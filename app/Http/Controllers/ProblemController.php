<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use Illuminate\Http\Request;

class ProblemController extends Controller
{
    public function index()
    {
        return Problem::where("private", 0)->paginate(20);
    }
}

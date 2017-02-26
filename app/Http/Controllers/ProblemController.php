<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use Illuminate\Http\Request;

class ProblemController extends Controller
{
    public function index()
    {
        return Problem::where("private", 0)->paginate(20, ['id', 'title', 'solved', 'submited']);
    }

    public function detail(Request $request)
    {
        $id = $request->input('id');
        return Problem::find($id);
    }
}

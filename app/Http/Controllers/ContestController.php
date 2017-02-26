<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use Illuminate\Http\Request;

class ContestController extends Controller
{
    public function index()
    {
        return Contest::where("private", 0)->paginate(20, ['id', 'title', 'start_time', 'end_time']);
    }

    public function detail(Request $request)
    {
       $id = $request->input('id');
       return Contest::find($id);
    }
}

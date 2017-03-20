<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        return Team::paginate(20, ['id', 'name', 'desc']);
    }

    public function rack()
    {
        return Team::paginate(20, ['id', 'name', 'desc']);
    }

    public function store(Request $request)
    {
        $team = new Team();

        $team->name = $request->input('name');
        $team->desc = $request->input('desc');

        $team->save();

        return $team->id;
    }

    public function show(Request $request)
    {
        $id = $request->input('id');
        return Team::find($id);
    }

    public function apply(Request $request)
    {
        $id = $request->input('id');
        return Team::find($id);
    }

    public function test()
    {
        return Team::with('users')->find(1);
    }
}

<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * @return Response
     */
    public function index(Request $request)
    {
        $users = User::all();
        return $users;
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
        if ($id === 0)  $user = Auth::user();
        else{
            $user = User::where('id', $id)->first();
        }
        return $user;
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
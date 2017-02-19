<?php

namespace App\Http\Controllers\User;

use App\Models\UserMeta;
use App\User;
use Request;
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
        $data = Request::all();

        $basicMeta = array_filter($data, function ($value, $key){return in_array($key, ['id', 'name']);}, ARRAY_FILTER_USE_BOTH);
        $otherMeta = array_filter($data, function ($value, $key){return !in_array($key, ['id', 'name']);}, ARRAY_FILTER_USE_BOTH);

        foreach ($otherMeta as $key=>$value)
        {
            UserMeta::updateOrCreate(['user_id'=>$id, 'meta_key'=>$key], ['user_id'=>$id, 'meta_key'=>$key, 'meta_value'=>$value ]);
        }

        $result = User::where('id', Request::input('id'))->update($basicMeta);
        return $result;
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
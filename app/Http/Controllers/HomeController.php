<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    public function menu()
    {
        $menu =
            [
                [
                    "menuName"=>"Profile",
                    "children"=>[
                        [
                            "menuName"=>"Account",
                            "children"=>[],
                            "url"=>"#/foo"
                        ],
                        [
                            "menuName"=>"Email",
                            "children"=>[],
                            "url"=>"#/bar"
                        ],
                        [
                            "menuName"=>"Obtain",
                            "children"=>[],
                            "url"=>"#/obtainProblem"
                        ],
                    ]
                ]
            ];
        return Response::json($menu);
    }
}

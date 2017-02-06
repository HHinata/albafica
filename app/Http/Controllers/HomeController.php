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
                            "url"=>"#/account"
                        ],
                        [
                            "menuName"=>"AccountList",
                            "children"=>[],
                            "url"=>"#/account-list"
                        ],
                        [
                            "menuName"=>"Obtain",
                            "children"=>[],
                            "url"=>"#/obtain-problem"
                        ],
                    ]
                ]
            ];
        return Response::json($menu);
    }
}

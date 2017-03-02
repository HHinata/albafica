<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function rank()
    {
        return User::orderBy("rating")->paginate(20);
    }
}

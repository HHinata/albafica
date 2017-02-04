<?php

namespace App\Http\Controllers;

use App\Contracts\ProblemContract;
use Request;
use Illuminate\Support\Facades\Response;

class ProblemController extends Controller
{
    //
    public function __construct(ProblemContract $problem)
    {
        $this->problem = $problem;
    }

    /**
     * Obtain from Judge platform
     */
    public function obtain()
    {
        $data = Request::all();

        $content = $this->problem
            ->setPlatform($data['platform'])
            ->obtainContent($data['id']);

        return Response::Json($content);
    }
}

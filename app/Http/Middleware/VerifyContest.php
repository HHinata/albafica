<?php

namespace App\Http\Middleware;

use App\Models\Contest;
use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyContest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $cookies = $request->cookie();
        $id = $request->input('id');
        $contest = Contest::find($id);

        switch ($contest->private)
        {
            case 0: break;
            case 1:
                $teams = Auth::user()->teams()->get()->toArray();
                if (in_array($contest->team_id, array_column($teams, 'id')) == false)
                    return response('',404);
                break;
            case 2:
                $pwd = $request->input('pwd', "");
                if ($pwd != "")  $cookies['cst-'.$id] = $pwd;
                if (isset($cookies['cst-'.$id])==false || $cookies['cst-'.$id]!=$contest->password)
                    return response('',404);
                break;
        }

        return $next($request);
    }
}

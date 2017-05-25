<?php

namespace App\Http\Middleware;

use App\Models\Team;
use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyTeam
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
        $id = $request->input('id');
        $team = Team::find($id);
        $user = Auth::user();

        if (is_null($user)) return response('',404);
        if ($user->hasRole('admin') === false){
            $user = $team->users()->where('user_id', $user->id)->first();
            if (is_null($user) || $user->pivot->role === 0) {
                return response('',404);
            }
        }
        return $next($request);
    }
}

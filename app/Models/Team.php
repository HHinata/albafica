<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    //
    public function users()
    {
        return $this->belongsToMany('App\User', 'team_user', 'team_id', 'user_id')->withPivot('role');
    }

    public function contests()
    {
        return $this->hasMany('App\Models\Contest');
    }

    public function comments()
    {
        return $this->morphToMany('App\Models\Comment', 'object', 'comment_links', 'object_id', 'comment_id');
    }

    public function userRole($uId)
    {
        $user = $this->users()->find($uId);
        return $user != null?$user->pivot->role:-1;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    //
    public function users()
    {
        return $this->belongsToMany('App\User', 'team_user', 'team_id', 'id');
    }
}

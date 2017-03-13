<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function problem()
    {
        return $this->hasOne('App\Models\Problem', 'id', 'problem_id');
    }
}

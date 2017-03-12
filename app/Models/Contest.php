<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    public function problems()
    {
        return $this->belongsToMany('App\Models\Problem', 'contest_problem', 'contest_id', 'problem_id');
    }
}

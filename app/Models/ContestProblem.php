<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContestProblem extends Model
{
    protected $table = 'contest_problem';
    //
    public function problem()
    {
        return $this->hasOne('App\Models\Problem', 'id', 'problem_id');
    }
}

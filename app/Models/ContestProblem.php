<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContestProblem extends Model
{
    protected $table = 'contest_problem';
    //
    protected $fillable = ['contest_id', 'alias', 'problem_id', 'order'];

    public function problem()
    {
        return $this->hasOne('App\Models\Problem', 'id', 'problem_id');
    }
}

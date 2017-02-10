<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContestProblem extends Model
{
    //
    /* set up the table */
    protected $table = 'contest_problem';

    protected $fillable=['contest_id', 'problem_id'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    //
    /* set up the table */
    protected $table = 'contest';

    protected $fillable = ['title', 'description', 'start_time', 'end_time'];

    public function problems()
    {
        return $this->belongsToMany('App\Models\Problem', 'contest_problem', 'contest_id', 'problem_id')->withTimestamps();
    }
}

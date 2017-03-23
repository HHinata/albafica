<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    protected $hidden = [
        'password'
    ];

    public function problems()
    {
        return $this->belongsToMany('App\Models\Problem', 'contest_problem', 'contest_id', 'problem_id');
    }

    public function comments()
    {
        return $this->morphToMany('App\Models\Comment', 'object', 'comment_links', 'object_id', 'comment_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'problem_tag', 'problem_id', 'tag_id');
    }
}

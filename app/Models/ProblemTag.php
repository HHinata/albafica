<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProblemTag extends Model
{
    protected $table = 'problem_tag';

    protected $fillable = ['problem_id', 'tag_id'];
}

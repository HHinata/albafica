<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    /* set up the table */
    protected $table = 'problem';

    protected $fillable = ['platform', 'sign', 'title', 'description', 'input', 'output', 'sample_input', 'sample_output'];

    public function contests()
    {
        return $this->belongsToMany('App\Models\Contest')->withTimestamps();
    }
}

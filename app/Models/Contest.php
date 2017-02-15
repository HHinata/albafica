<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    //
    /* set up the table */
    protected $table = 'contest';

    protected $fillable = ['title', 'description', 'start_time', 'end_time'];

}

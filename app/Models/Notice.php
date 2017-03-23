<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    public function post()
    {
        return $this->hasOne('App\Models\Post', 'id', 'post_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'object', 'tag_links', 'object_id', 'tag_id');
    }

    public function users()
    {
        return $this->morphToMany('App\User', 'object', 'user_links', 'object_id', 'user_id');
    }
}

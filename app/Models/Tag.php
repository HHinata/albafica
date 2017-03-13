<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts()
    {
        return $this->morphedByMany('App\Models\Post', 'object', 'tag_links', 'tag_id');
    }

    public function problems()
    {
        return $this->morphedByMany('App\Models\Problem', 'object', 'tag_links', 'tag_id');
    }
}

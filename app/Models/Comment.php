<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function comments()
    {
        return $this->morphToMany('App\Models\Comment', 'object', 'comment_links', 'object_id', 'comment_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'object', 'tag_links', 'object_id', 'tag_id');
    }

    public function users()
    {
        return $this->morphToMany('App\User', 'object', 'user_links', 'object_id', 'user_id');
    }

    public function comments()
    {
        return $this->morphToMany('App\Models\Comment', 'object', 'comment_links', 'object_id', 'comment_id');
    }
}

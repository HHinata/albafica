<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    protected $fillable = ["id","platform","sign","title","desc","input","output",
        "sample_input","sample_output","data_input","data_output","solved",
        "submited","time_limit","mem_limit","hint",
        "author","source","private ","created_at"];

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

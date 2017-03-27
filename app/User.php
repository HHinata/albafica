<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * Get the solution
     */
    public function solution()
    {
        return $this->hasMany('App\Models\Solution');
    }

    public function message()
    {
        return $this->hasMany('App\Models\Message');
    }

    public function problems()
    {
        return $this->morphedByMany('App\Models\Problem', 'object', 'user_links', 'user_id');
    }

    public function posts()
    {
        return $this->morphedByMany('App\Models\Post', 'object', 'user_links', 'user_id');
    }

    public function followers()
    {
        return $this->morphToMany('App\User', 'object', 'user_links', 'object_id', 'user_id');
    }

    public function followings()
    {
        return $this->morphedByMany('App\User', 'object', 'user_links', 'user_id');
    }

    public function teams()
    {
        return $this->belongsToMany('App\Models\Team', 'team_user', 'user_id', 'team_id');
    }
}

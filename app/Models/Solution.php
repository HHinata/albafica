<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    /* set up the table */
    protected $table = 'solution';

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    /**
     * Add a solution record
     *
     * [uid, pid, lang, rid]
     */
    public function join(Array $solution)
    {
        $this->user_id = $solution['uid'];
        $this->language = $solution['lang'];
        $this->problem_id = $solution['pid'];
        $this->run_id = $solution['rid']?:"";
        $this->contest_id = isset($solution['cid'])?$solution['cid']:0;
        $this->save();
    }

}

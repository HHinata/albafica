<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public static function send($uid, $title, $msg)
    {
        $message = new Message();
        $message->title = $title;
        $message->content = $msg;
        $message->user_id = $uid;
        $message->save();
        return $message->id;
    }

    public static function sendAll($uids, $title, $msg)
    {
        $mids = [];
        if (is_array($uids)) {
            foreach ($uids as $uid){
                $message = new Message();
                $message->title = $title;
                $message->content = $msg;
                $message->user_id = $uid;
                $message->save();
                $mids[] = $message->id;
            }
        }
        return $mids;
    }
}

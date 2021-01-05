<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded=[];
    protected $fillable=['user_id','receiver_id','image','message','channel_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }


    function type()
    {
        if (!is_null($this->message)) return "text";
        if (substr($this->image,-3) == "3gp") return "voice";
        return "image";
    }

    public function getChannelAttribute()
    {
        $arr = array_sort($this->only('user_id', 'receiver_id'));
        return 'privatechat.' . implode('_', $arr);
    }
}

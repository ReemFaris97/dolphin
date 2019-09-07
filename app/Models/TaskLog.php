<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskLog extends Model
{
    public  $fillable=['old_user_id', 'new_user_id', 'task_id', 'notes'];


    public  function old_user(){
        return $this->belongsTo('App\User','old_user_id');
    }
    public  function new_user(){
        return $this->belongsTo('App\User','new_user_id');
    }
}

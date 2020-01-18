<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class  AccountingSession extends Model
{
    protected $fillable = ['device_id','shift_id','user_id','password','code','status','custody'];


    public  function shift(){
        return $this->belongsTo(AccountingBranchShift::class,'shift_id');

    }
}

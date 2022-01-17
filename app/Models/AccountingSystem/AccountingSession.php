<?php

namespace App\Models\AccountingSystem;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class AccountingSession extends Model
{
    protected $fillable = ['device_id','shift_id','user_id','code','status','custody','start_session','end_session','store_id'];


    public function shift()
    {
        return $this->belongsTo(AccountingBranchShift::class, 'shift_id');
    }

    public function device()
    {
        return $this->belongsTo(AccountingDevice::class, 'device_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

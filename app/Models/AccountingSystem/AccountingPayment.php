<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingPayment extends Model
{
    protected $fillable = ['name','type','safe_id','bank_id','active'];

    public function bank()
    {
        return $this->belongsTo(AccountingBank::class,'bank_id');
    }
    public function safe()
    {
        return $this->belongsTo(AccountingSafe::class,'safe_id');
    }
}

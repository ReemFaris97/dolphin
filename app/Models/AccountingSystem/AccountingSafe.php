<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingSafe extends Model
{
    protected $fillable = ['branch_id','code','financial_custody'];

protected  $table='accounting_safes';

    public function branch()
    {
        return $this->belongsTo(AccountingBranch::class,'branch_id');
    }



}

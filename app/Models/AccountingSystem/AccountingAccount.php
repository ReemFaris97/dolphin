<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingAccount extends Model
{
    protected $fillable = ['ar_name','en_name','kind','status','code','account_id','active','amount','supplier_id','store_id','bank_id'];
    protected $table='accounting_accounts';
    public function account()
    {
     return $this->belongsTo(AccountingAccount::class,'account_id');
    }
}

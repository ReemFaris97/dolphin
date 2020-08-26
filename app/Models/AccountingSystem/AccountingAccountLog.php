<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingAccountLog extends Model
{
    protected $fillable = ['entry_id','account_id','account_amount_before','another_account_id','affect','amount','account_amount_after','status'];
    protected $table='accounting_accounts_logs';

    public function entry()
    {
        return $this->belongsTo(AccountingEntry::class,'entry_id');
    }
    public function account()
    {
        return $this->belongsTo(AccountingAccount::class,'account_id');
    }
    public function another_account()
    {
        return $this->belongsTo(AccountingAccount::class,'another_account_id');
    }
}

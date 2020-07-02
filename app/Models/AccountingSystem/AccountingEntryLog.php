<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingEntryLog extends Model
{
    protected $fillable = ['entry_id','operation','user_id','account_id','debtor','creditor'];
    protected $table='accounting_entries_log';

    public function entry()
    {
        return $this->belongsTo(AccountingEntry::class,'entry_id');
    }
    public function account()
    {
        return $this->belongsTo(AccountingAccount::class,'account_id');
    }

}

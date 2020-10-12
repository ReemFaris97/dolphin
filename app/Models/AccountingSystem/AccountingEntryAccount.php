<?php

namespace App\Models\AccountingSystem;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingEntryAccount extends Model
{
    protected $fillable = ['amount','account_id','entry_id','affect'];
    protected $table='accounting_entries_accounts';

    public function entry()
    {
        return $this->belongsTo(AccountingEntry::class,'entry_id');
    }

    public function account()
    {
        return $this->belongsTo(AccountingAccount::class,'account_id');
    }
    
}


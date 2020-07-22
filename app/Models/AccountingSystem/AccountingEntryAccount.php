<?php

namespace App\Models\AccountingSystem;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingEntryAccount extends Model
{
    protected $fillable = ['amount','from_account_id','to_account_id','entry_id'];
    protected $table='accounting_entries_accounts';

    public function entry()
    {
        return $this->belongsTo(AccountingEntry::class,'entry_id');
    }
    public function from_account()
    {
        return $this->belongsTo(AccountingAccount::class,'from_account_id');
    }
    public function to_account()
    {
        return $this->belongsTo(AccountingAccount::class,'to_account_id');
    }
}


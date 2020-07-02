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
}


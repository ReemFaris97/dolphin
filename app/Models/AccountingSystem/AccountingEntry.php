<?php

namespace App\Models\AccountingSystem;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingEntry extends Model
{
    protected $fillable = ['date','source','type','code','currency','amount','details','status'];
    protected $table='accounting_entries';

    public function accounts()
    {
        return $this->hasMany(AccountingEntryAccount::class,'entry_id');
    }
    public function accounts_debtor()
    {
        $accounts_debtor=AccountingEntryAccount::where('entry_id',$this->id)->where('affect','debtor')->get();
        return $accounts_debtor;
    }

    public function accounts_creditor()
    {
        $accounts_creditor=AccountingEntryAccount::where('entry_id',$this)->where('affect','creditor')->get();
        return $accounts_creditor;
    }
}


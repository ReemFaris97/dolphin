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

}


<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingAccountSetting extends Model
{
    protected $fillable = ['increased_number','automatic','status','main_code','account_id'];
    protected $table='accounting_accounts_settings';

    public function account()
    {
        return $this->belongsTo(AccountingAccount::class,'account_id');
    }

}

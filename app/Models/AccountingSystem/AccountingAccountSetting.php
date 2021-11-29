<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingAccountSetting
 *
 * @property-read \App\Models\AccountingSystem\AccountingAccount $account
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountSetting query()
 * @mixin \Eloquent
 */
class AccountingAccountSetting extends Model
{
    protected $fillable = ['increased_number','automatic','status','main_code','account_id'];
    protected $table='accounting_accounts_settings';

    public function account()
    {
        return $this->belongsTo(AccountingAccount::class,'account_id');
    }

}

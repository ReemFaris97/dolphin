<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingBank
 *
 * @property int $id
 * @property string $name
 * @property string|null $bank_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $en_name
 * @property string|null $account_name
 * @property string|null $account_num
 * @property int|null $currency_id
 * @property int|null $active
 * @property string|null $notes
 * @property int|null $account_id
 * @property-read \App\Models\AccountingSystem\AccountingAccount|null $account
 * @property-read \App\Models\AccountingSystem\AccountingCurrency|null $currency
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBank newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBank query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBank whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBank whereAccountName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBank whereAccountNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBank whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBank whereBankNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBank whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBank whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBank whereEnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBank whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBank whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBank whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBank whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingBank extends Model
{
    protected $fillable = [
        "name",
        "bank_number",
        "en_name",
        "account_name",
        "account_num",
        "currency_id",
        "active",
        "notes",
        "account_id",
    ];
    protected $table = "accounting_banks";
    public function currency()
    {
        return $this->belongsTo(AccountingCurrency::class, "currency_id");
    }

    public function account()
    {
        return $this->belongsTo(AccountingAccount::class, "account_id");
    }
}

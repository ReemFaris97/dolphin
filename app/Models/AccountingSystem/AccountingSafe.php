<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingSafe
 *
 * @property int $id
 * @property string|null $model_type
 * @property int|null $model_id
 * @property string|null $custody
 * @property string|null $name
 * @property int|null $type
 * @property int|null $device_id
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $amount
 * @property string|null $status
 * @property string|null $account_name
 * @property string|null $account_num
 * @property int|null $currency_id
 * @property int|null $active
 * @property string|null $notes
 * @property int|null $account_id
 * @property-read \App\Models\AccountingSystem\AccountingAccount|null $account
 * @property-read \App\Models\AccountingSystem\AccountingBranch|null $branch
 * @property-read \App\Models\AccountingSystem\AccountingCompany|null $company
 * @property-read \App\Models\AccountingSystem\AccountingCurrency|null $currency
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereAccountName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereAccountNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereCustody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereDeviceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingSafe extends Model
{
    protected $fillable = [
        "device_id",
        "name",
        "custody",
        "model_type",
        "type",
        "model_id",
        "amount",
        "status",
        "account_name",
        "account_num",
        "currency_id",
        "active",
        "notes",
        "account_id",
    ];

    protected $table = "accounting_safes";

    public function branch()
    {
        return $this->belongsTo(AccountingBranch::class, "model_id");
    }
    public function account()
    {
        return $this->belongsTo(AccountingAccount::class, "account_id");
    }

    public function company()
    {
        return $this->belongsTo(AccountingCompany::class, "model_id");
    }
    public function currency()
    {
        return $this->belongsTo(AccountingCurrency::class, "currency_id");
    }
}

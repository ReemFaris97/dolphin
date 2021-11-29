<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingAsset
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $currency_id
 * @property string|null $purchase_price
 * @property string|null $purchase_date
 * @property int|null $payment_id
 * @property int|null $account_id
 * @property string|null $damage_start_date
 * @property string|null $damage_end_date
 * @property string|null $damage_type
 * @property string|null $damage_period
 * @property string|null $damage_period_type
 * @property string|null $damage_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingAssetDamageLog[] $AssetLogs
 * @property-read int|null $asset_logs_count
 * @property-read \App\Models\AccountingSystem\AccountingAccount|null $account
 * @property-read \App\Models\AccountingSystem\AccountingCurrency|null $currency
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingCustodyLog[] $custodyLogs
 * @property-read int|null $custody_logs_count
 * @property-read \App\Models\AccountingSystem\AccountingPayment|null $payment
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset whereDamageEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset whereDamagePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset whereDamagePeriodType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset whereDamagePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset whereDamageStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset whereDamageType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset wherePurchaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset wherePurchasePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingAsset extends Model
{


    protected $fillable = ['name','currency_id','purchase_price','purchase_date','payment_id','account_id','damage_start_date','damage_end_date','damage_type','damage_period'
,'damage_period_type','damage_price','type'
];
    protected $table='accounting_assets';


    public function currency()
    {
        return $this->belongsTo(AccountingCurrency::class,'currency_id');
    }

    public function payment()
    {
        return $this->belongsTo(AccountingPayment::class,'payment_id');
    }
    public function account()
    {
        return $this->belongsTo(AccountingAccount::class,'account_id');
    }
    public function AssetLogs()
    {

          return $this->hasMany(AccountingAssetDamageLog::class,'asset_id');

    }

    public function custodyLogs()
    {

          return $this->hasMany(AccountingCustodyLog::class,'asset_id');

    }
}


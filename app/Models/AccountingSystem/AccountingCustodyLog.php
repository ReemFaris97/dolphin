<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingCustodyLog
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $operation_name
 * @property int|null $asset_id
 * @property string|null $amount
 * @property string|null $amount_asset_after
 * @property string|null $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $payment_id
 * @property-read \App\Models\AccountingSystem\AccountingAsset|null $asset
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCustodyLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCustodyLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCustodyLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCustodyLog whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCustodyLog whereAmountAssetAfter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCustodyLog whereAssetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCustodyLog whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCustodyLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCustodyLog whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCustodyLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCustodyLog whereOperationName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCustodyLog wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCustodyLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingCustodyLog extends Model
{
    protected $fillable = [
        "asset_id",
        "code",
        "date",
        "amount",
        "amount_asset_after",
        "operation_name",
        "payment_id",
    ];
    protected $table = "accounting_custody_logs";
    public function asset()
    {
        return $this->belongsTo(AccountingAsset::class, "asset_id");
    }
}

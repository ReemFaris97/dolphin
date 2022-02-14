<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingAssetDamageLog
 *
 * @property int $id
 * @property string|null $code
 * @property int|null $asset_id
 * @property string|null $amount
 * @property string|null $amount_asset_after
 * @property string|null $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AccountingSystem\AccountingAsset|null $asset
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAssetDamageLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAssetDamageLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAssetDamageLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAssetDamageLog whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAssetDamageLog whereAmountAssetAfter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAssetDamageLog whereAssetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAssetDamageLog whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAssetDamageLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAssetDamageLog whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAssetDamageLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAssetDamageLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingAssetDamageLog extends Model
{
    protected $fillable = [
        "asset_id",
        "code",
        "date",
        "amount",
        "amount_asset_after",
    ];
    protected $table = "accounting_asset_damaged_logs";
    public function asset()
    {
        return $this->belongsTo(AccountingAsset::class, "asset_id");
    }
}

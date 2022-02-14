<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingPayment
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $type
 * @property int|null $safe_id
 * @property int|null $bank_id
 * @property int|null $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AccountingSystem\AccountingBank|null $bank
 * @property-read \App\Models\AccountingSystem\AccountingSafe|null $safe
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPayment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPayment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPayment query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPayment whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPayment whereBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPayment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPayment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPayment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPayment whereSafeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPayment whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPayment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingPayment extends Model
{
    protected $fillable = ["name", "type", "safe_id", "bank_id", "active"];

    public function bank()
    {
        return $this->belongsTo(AccountingBank::class, "bank_id");
    }
    public function safe()
    {
        return $this->belongsTo(AccountingSafe::class, "safe_id");
    }
}

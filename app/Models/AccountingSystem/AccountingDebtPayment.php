<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingDebtPayment
 *
 * @property int $id
 * @property int $debt_id
 * @property string $date
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebtPayment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebtPayment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebtPayment query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebtPayment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebtPayment whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebtPayment whereDebtId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebtPayment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebtPayment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebtPayment whereValue($value)
 * @mixin \Eloquent
 */
class AccountingDebtPayment extends Model
{
    protected $fillable = ["debt_id", "date", "value"];
}

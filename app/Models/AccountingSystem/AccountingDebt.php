<?php

namespace App\Models\AccountingSystem;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingDebt
 *
 * @property int $id
 * @property string $typeable_type
 * @property int $typeable_id
 * @property \Illuminate\Support\Carbon $date
 * @property string $value
 * @property string|null $reason
 * @property-read int|null $payments_count
 * @property \Illuminate\Support\Carbon|null $pay_from
 * @property string|null $notes
 * @property int $payed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingDebtPayment[] $payments
 * @property-read Model|\Eloquent $typeable
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebt newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebt newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebt query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebt whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebt whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebt whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebt wherePayFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebt wherePayed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebt wherePaymentsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebt whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebt whereTypeableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebt whereTypeableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebt whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebt whereValue($value)
 * @mixin \Eloquent
 */
class AccountingDebt extends Model
{
    protected $dates = ["date", "pay_from"];
    protected $fillable = [
        "typeable_type",
        "typeable_id",
        "date",
        "value",
        "reason",
        "payments_count",
        "pay_from",
        "notes",
        "payed",
    ];

    public function typeable()
    {
        return $this->morphTo();
    }

    public function payments()
    {
        return $this->hasMany(AccountingDebtPayment::class, "debt_id");
    }

    public function paymentWithPayed()
    {
        for ($i = 1; $i <= $this->payments_count; $i++) {
            $debt[$i]["date"] = Carbon::parse($this->pay_from)->addMonths(
                $i - 1
            );
            $debt[$i]["amount"] = $this->value / $this->payments_count;
            $debt[$i]["payed"] =
                $this->payments
                    ->where("date", ">=", $debt[$i]["date"]->format("Y-m-01"))
                    ->where(
                        "date",
                        "<=",
                        $debt[$i]["date"]->format("Y-m-31 23:59:59")
                    )
                    ->count() > 0;
            $debt[$i]["is_current"] =
                $debt[$i]["date"]->format("Y-m-01 00:00:00") <=
                now()->format("Y-m-31");
            $debt[$i] = (object) $debt[$i];
        }
        return $debt;
    }
}

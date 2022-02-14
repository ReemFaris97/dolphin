<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingFiscalPeriod
 *
 * @property int $id
 * @property int|null $year_id
 * @property string|null $type
 * @property string|null $name
 * @property string|null $from
 * @property string|null $to
 * @property string|null $duration
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AccountingSystem\AccountingFiscalYear|null $year
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalPeriod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalPeriod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalPeriod query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalPeriod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalPeriod whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalPeriod whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalPeriod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalPeriod whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalPeriod whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalPeriod whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalPeriod whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalPeriod whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalPeriod whereYearId($value)
 * @mixin \Eloquent
 */
class AccountingFiscalPeriod extends Model
{
    protected $fillable = [
        "year_id",
        "name",
        "from",
        "to",
        "status",
        "type",
        "duration",
    ];
    protected $table = "accounting_fiscal_periods";
    public function year()
    {
        return $this->belongsTo(AccountingFiscalYear::class, "year_id");
    }
}

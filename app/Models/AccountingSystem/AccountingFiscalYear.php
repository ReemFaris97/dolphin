<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingFiscalYear
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $from
 * @property string|null $to
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingFiscalPeriod[] $periods
 * @property-read int|null $periods_count
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalYear newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalYear newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalYear query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalYear whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalYear whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalYear whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalYear whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalYear whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalYear whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalYear whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingFiscalYear extends Model
{


    protected $fillable = ['name','from','to','status'];
    protected $table='accounting_fiscal_years';
    public function periods()
    {
        return $this->hasMany(AccountingFiscalPeriod::class,'year_id');
    }


}


<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingUserHolidaysBalance
 *
 * @property int $id
 * @property string $typeable_type
 * @property int $typeable_id
 * @property int $holiday_id
 * @property int $days
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $start_date
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AccountingSystem\AccountingHoliday $holiday
 * @property-read Model|\Eloquent $typeable
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserHolidaysBalance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserHolidaysBalance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserHolidaysBalance query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserHolidaysBalance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserHolidaysBalance whereDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserHolidaysBalance whereHolidayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserHolidaysBalance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserHolidaysBalance whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserHolidaysBalance whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserHolidaysBalance whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserHolidaysBalance whereTypeableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserHolidaysBalance whereTypeableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserHolidaysBalance whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingUserHolidaysBalance extends Model
{
    protected $fillable = ['typeable_id','typeable_type', 'holiday_id', 'days', 'type','start_date','notes'];
    protected $dates = ['start_date'];
    protected $table='accounting_holiday_balances';

    public function typeable(){
        return $this->morphTo('typeable');
    }
    public function holiday(){
        return $this->belongsTo(AccountingHoliday::class,'holiday_id');
    }
}

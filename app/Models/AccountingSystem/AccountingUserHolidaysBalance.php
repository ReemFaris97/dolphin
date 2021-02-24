<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

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

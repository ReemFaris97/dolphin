<?php

namespace App\Models\AccountingSystem;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class AccountingDebt extends Model
{
    protected $dates = ['date','pay_from'];
    protected $fillable=['typeable_type','typeable_id','date','value','reason','payments_count','pay_from','notes','payed'];

    public function typeable()
    {
        return $this->morphTo('typeable_type');
    }

    public function payments(){
        return $this->hasMany(AccountingDebtPayment::class,'debt_id');
    }

    public function paymentWithPayed(){
        for($i=1;$i<=$this->payments_count;$i++){
            $debt[$i]['date'] = Carbon::parse($this->pay_from)->addMonths($i-1);
            $debt[$i]['amount'] = $this->value/$this->payments_count;
            $debt[$i]['payed'] = $this->payments->where('date','>=',$debt[$i]['date']->format('Y-m-01'))
                    ->where('date','<=',$debt[$i]['date']->format('Y-m-31 23:59:59'))->count() > 0;
            $debt[$i]['is_current'] = $debt[$i]['date']->format('Y-m-01 00:00:00') <= now()->format('Y-m-31');
            $debt[$i] = (object)$debt[$i];
        }
        return $debt;
    }
}

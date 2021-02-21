<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingDebt extends Model
{
    protected $fillable=['typeable_type','typeable_id','date','value','reason','payments_count','pay_from','notes','payed'];
}

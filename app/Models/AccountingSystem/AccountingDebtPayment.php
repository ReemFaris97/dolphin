<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingDebtPayment extends Model
{
    protected $fillable=['debt_id','date','value'];
}

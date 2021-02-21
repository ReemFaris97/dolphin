<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingUserHolidaysBalance extends Model
{
    protected  $fillable=['typeable_type','typeable_id','allowance_id','value'];
}

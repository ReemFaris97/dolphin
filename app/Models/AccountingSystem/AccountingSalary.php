<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingSalary extends Model
{
    protected $fillable=['typeable_type','typeable_id','salary','allowance','bonus','discount','date','total'];
}

<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingCostCenter extends Model
{


    protected $fillable = ['name','active'];
    protected $table='accounting_cost_centers';

  


}


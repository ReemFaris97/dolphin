<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingCostCenter extends Model
{


    protected $fillable = ['name','active','code','center_id','kind'];
    protected $table='accounting_cost_centers';

    public function children()
    {
        return $this->hasMany(AccountingCostCenter::class,'center_id');
    }



}


<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingCenterAccount extends Model
{


    protected $fillable = ['account_id','center_id'];
    protected $table='accounting_centers_accounts';


    public function center()
    {
        return $this->belongsTo(AccountingCostCenter::class,'center_id');
    }


}


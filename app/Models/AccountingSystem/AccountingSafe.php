<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingSafe extends Model
{
    protected $fillable = ['device_id','name','custody','model_type','type','model_id','amount','status','account_name','account_num','currency_id','active','notes'];

    protected  $table='accounting_safes';

    public function branch()
    {
        return $this->belongsTo(AccountingBranch::class,'model_id');
    }

    public function company()
    {
        return $this->belongsTo(AccountingCompany::class,'model_id');
    }
    public function currency()
    {
        return $this->belongsTo(AccountingCurrency::class,'currency_id');
    }

}

<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class  AccountingDevice extends Model
{
    protected $fillable = ['store_id','name','code','model_id','model_type','available'];


    public  function clause(){
        return $this->belongsTo(AccountingMoneyClause::class,'clause_id');

    }

    public function branch()
    {
        return $this->belongsTo(AccountingBranch::class,'model_id');
    }

    public function company()
    {
        return $this->belongsTo(AccountingCompany::class,'model_id');
    }
}

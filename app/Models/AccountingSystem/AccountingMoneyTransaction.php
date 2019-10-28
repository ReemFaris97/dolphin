<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingMoneyTransaction extends Model
{
    protected  $fillable=['amount','model_type','model_id','clause_id','notes'];
    public  function clause(){
        return $this->belongsTo(AccountingMoneyClause::class,'clause_id');

    }

}

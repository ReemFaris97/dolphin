<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class  AccountingDevice extends Model
{
    protected $fillable = ['store_id','name','code'];


    public  function clause(){
        return $this->belongsTo(AccountingMoneyClause::class,'clause_id');

    }
}

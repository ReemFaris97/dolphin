<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingMoneyClause extends Model
{
    protected $fillable = ['ar_name','en_name','type','default','en_description','ar_description','safe_id','amount','concerned','client_id','supplier_id',];

    public function   safe(){
        return $this->belongsTo(AccountingSafe::class,'safe_id');
    }

    public function client()
    {
        return $this->belongsTo(AccountingCompany::class,'client_id');
    }
    
}


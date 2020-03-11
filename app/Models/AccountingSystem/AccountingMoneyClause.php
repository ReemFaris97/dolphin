<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingMoneyClause extends Model
{
    protected $fillable = ['benod_id','type','default','sanad_num',
    'safe_id','amount','concerned','client_id','supplier_id',];

    public function   safe(){
        return $this->belongsTo(AccountingSafe::class,'safe_id');
    }

    public function client()
    {
        return $this->belongsTo(AccountingCompany::class,'client_id');
    }

    public function benod()
    {
        return $this->belongsTo(AccountingBenod::class,'benod_id');
    }

}


<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingMoneyClause extends Model
{
    protected $fillable = ['benod_id','type','default','sanad_num','user_id','num',
    'safe_id','amount','concerned','client_id','supplier_id','notes','payment','company_id','branch_id'];

    public function   safe(){
        return $this->belongsTo(AccountingSafe::class,'safe_id');
    }

    public function client()
    {
        return $this->belongsTo(AccountingClient::class,'client_id');
    }
    public function company()
    {
        return $this->belongsTo(AccountingCompany::class,'company_id');
    }

    public function branch()
    {
        return $this->belongsTo(AccountingBranch::class,'branch_id');
    }



    public function benod()
    {
        return $this->belongsTo(AccountingBenod::class,'benod_id');
    }

}


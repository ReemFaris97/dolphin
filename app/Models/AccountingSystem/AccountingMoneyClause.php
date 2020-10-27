<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingMoneyClause extends Model
{
    protected $fillable = ['benod_id','type','default','sanad_num','user_id','num','description','date',
    'safe_id','amount','notes','revenue_account_id',
        'bank_id','num_transaction','image','name','center_id','account_id','payment_id'];

    public function  safe(){
        return $this->belongsTo(AccountingSafe::class,'safe_id');
    }

    public function client()
    {
        return $this->belongsTo(AccountingClient::class,'client_id');
    }

    public function bank()
    {
        return $this->belongsTo(AccountingBank::class,'bank_id');
    }


    public function payment()
    {
        return $this->belongsTo(AccountingPayment::class,'payment_id');
    }
    public function supplier()
    {
        return $this->belongsTo(AccountingSupplier::class,'supplier_id');
    }

    public function company()
    {
        return $this->belongsTo(AccountingCompany::class,'company_id');
    }

    public function center()
    {
        return $this->belongsTo(AccountingCostCenter::class,'center_id');
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


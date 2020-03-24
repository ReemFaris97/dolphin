<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingPurchase extends Model
{


    protected $fillable = ['supplier_id','total','amount','discount','payment','payed','debts','package_id','store_id','bill_num','totalTaxs'
             ,'safe_id','user_id','company_id','branch_id','discount_type','bill_date','counter','daily_number','counter_purchase'];
    protected $table='accounting_purchases';


    public function supplier()
    {
        return $this->belongsTo(AccountingSupplier::class,'supplier_id');
    }

    public function session()
    {
        return $this->belongsTo(AccountingSession::class,'session_id');
    }

    public function safe()
    {
        return $this->belongsTo(AccountingSafe::class,'safe_id');
    }

    public function company()
    {
        return $this->belongsTo(AccountingCompany::class,'company_id');
    }
    public function branch()
    {
        return $this->belongsTo(AccountingBranch::class,'branch_id');
    }

    public function store()
    {
        return $this->belongsTo(AccountingStore::class,'store_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function items()
    {
        return $this->hasMany(AccountingPurchaseItem::class, 'purchase_id');
    }
}

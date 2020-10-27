<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class AccountingPurchaseReturn extends Model
{


    protected $fillable = ['total','purchase_id','amount','discount','supplier_id','store_id',
    'payment','payed','totalTaxs','bill_num','discount_type','bill_date','branch_id','safe_id','user_id'];

    protected $table='accounting_purchases_returns';


    public function supplier()
    {
        return $this->belongsTo(AccountingSupplier::class,'supplier_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }


    public function purchase()
    {
        return $this->belongsTo(AccountingPurchase::class,'purchase_id');
    }

    public function items()
    {
        return $this->hasMany(AccountingPurchaseReturnItem::class, 'purchase_return_id');
    }
}

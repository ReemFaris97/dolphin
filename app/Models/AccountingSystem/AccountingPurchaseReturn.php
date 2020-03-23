<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingPurchaseReturn extends Model
{


    protected $fillable = ['total','purchase_id','amount','discount','supplier_id','store_id',
    'payment','payed','totalTaxs','bill_num','discount_type','bill_date'];

    protected $table='accounting_purchases_returns';





    public function purchase()
    {
        return $this->belongsTo(AccountingPurchase::class,'purchase_id');
    }

}

<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingPurchaseReturn extends Model
{


    protected $fillable = ['total','purchase_id'];
    protected $table='accounting_purchases_returns';





    public function purchase()
    {
        return $this->belongsTo(AccountingPurchase::class,'purchase_id');
    }

}

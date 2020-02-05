<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingPurchaseReturnItem extends Model
{


    protected $fillable = ['product_id','quantity','purchase_return_id'];
    protected $table='accounting_purchase_return_items';

    public function product()
    {
        return $this->belongsTo(AccountingProduct::class,'product_id');
    }

}

<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingPurchaseItem extends Model
{


    protected $fillable = ['product_id','quantity','price','purchase_id'];
    protected $table='accounting_purchases_items';

    
    public function product()
    {
        return $this->belongsTo(AccountingProduct::class,'product_id');
    }
}

<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingPurchaseItem extends Model
{


    protected $fillable = ['product_id','quantity','price','purchase_return_id','tax','unit_id','price_after_tax'];
    protected $table='accounting_purchases_items';


    public function product()
    {
        return $this->belongsTo(AccountingProduct::class,'product_id');
    }
}

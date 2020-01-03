<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierBillProduct extends Model
{
    protected $guarded = ['id'];

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

    public function supplier_bill(){
        return $this->belongsTo(SupplierBill::class,'supplier_bill_id');
    }
}

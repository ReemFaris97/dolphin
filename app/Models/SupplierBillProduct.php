<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SupplierBillProduct
 *
 * @property int $id
 * @property int $supplier_bill_id
 * @property int $product_id
 * @property int $quantity
 * @property float $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\SupplierBill $supplier_bill
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBillProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBillProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBillProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBillProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBillProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBillProduct wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBillProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBillProduct whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBillProduct whereSupplierBillId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBillProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

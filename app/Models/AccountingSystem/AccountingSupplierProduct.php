<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingSupplierProduct
 *
 * @property int $id
 * @property int|null $supplier_id
 * @property int|null $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierProduct whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingSupplierProduct extends Model
{


    protected $fillable = ['supplier_id','product_id'];
    protected $table='accounting_suppliers_products';




}

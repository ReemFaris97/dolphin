<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingReturnSaleItem
 *
 * @property int $id
 * @property int|null $sale_return_id
 * @property int|null $product_id
 * @property string|null $quantity
 * @property string|null $price
 * @property int|null $unit_id
 * @property string|null $unit_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AccountingSystem\AccountingProduct|null $product
 * @property-read AccountingReturnSaleItem|null $sale
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem whereSaleReturnId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem whereUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem whereUnitType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingReturnSaleItem extends Model
{


    protected $fillable = ['sale_return_id','product_id','quantity','price','unit_id','unit_type'];
    protected $table='accounting_sales_returns_item';


    public function sale()
    {
        return $this->belongsTo(AccountingReturnSaleItem::class,'sale_return_id');
    }

    public function product()
    {
        return $this->belongsTo(AccountingProduct::class,'product_id');
    }


}


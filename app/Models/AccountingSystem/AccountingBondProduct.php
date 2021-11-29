<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingBondProduct
 *
 * @property int $id
 * @property int|null $bond_id
 * @property int|null $product_id
 * @property int|null $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property float|null $price
 * @property-read \App\Models\AccountingSystem\AccountingProduct|null $product
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBondProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBondProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBondProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBondProduct whereBondId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBondProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBondProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBondProduct wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBondProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBondProduct whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBondProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingBondProduct extends Model
{


    protected $fillable = ['quantity','product_id','bond_id','price'];
    protected $table='accounting_bond_products';
    public function product()
    {
        return $this->belongsTo(AccountingProduct::class,'product_id');
    }



}

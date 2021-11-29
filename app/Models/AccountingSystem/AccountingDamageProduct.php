<?php

namespace App\Models\AccountingSystem;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingDamageProduct
 *
 * @property int $id
 * @property int|null $damage_id
 * @property int|null $product_id
 * @property int|null $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AccountingSystem\AccountingDamage|null $damage
 * @property-read \App\Models\AccountingSystem\AccountingProduct|null $product
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamageProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamageProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamageProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamageProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamageProduct whereDamageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamageProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamageProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamageProduct whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamageProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingDamageProduct extends Model
{
    protected $fillable = ['quantity','product_id','damage_id',];


    protected  $table='accounting_damages_products';


    public function product()
    {
        return $this->belongsTo(AccountingProduct::class,'product_id');
    }
    public function damage()
    {
        return $this->belongsTo(AccountingDamage::class,'damage_id');
    }
}



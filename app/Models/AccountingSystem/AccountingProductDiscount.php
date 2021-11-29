<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingProductDiscount
 *
 * @property int $id
 * @property int|null $product_id
 * @property string|null $discount_type
 * @property string|null $quantity
 * @property string|null $gift_quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $percent
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductDiscount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductDiscount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductDiscount query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductDiscount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductDiscount whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductDiscount whereGiftQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductDiscount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductDiscount wherePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductDiscount whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductDiscount whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductDiscount whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingProductDiscount extends Model
{
    protected $fillable = [ 'product_id','discount_type', 'quantity', 'gift_quantity','percent'];


}

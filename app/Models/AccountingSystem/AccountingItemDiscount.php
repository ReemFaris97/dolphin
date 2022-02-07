<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingItemDiscount
 *
 * @property int $id
 * @property string|null $discount_type
 * @property int|null $discount
 * @property int|null $affect_tax
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $item_id
 * @property string|null $type
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingItemDiscount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingItemDiscount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingItemDiscount query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingItemDiscount whereAffectTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingItemDiscount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingItemDiscount whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingItemDiscount whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingItemDiscount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingItemDiscount whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingItemDiscount whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingItemDiscount whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingItemDiscount extends Model
{
    protected $fillable = [
        "type",
        "discount",
        "discount_type",
        "affect_tax",
        "item_id",
    ];
    protected $table = "accounting_items_discounts";
}

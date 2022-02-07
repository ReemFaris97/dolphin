<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OfferProduct
 *
 * @property int $id
 * @property int $supplier_offer_id
 * @property int $product_id
 * @property float $price
 * @property int $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|OfferProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OfferProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OfferProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|OfferProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferProduct wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferProduct whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferProduct whereSupplierOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OfferProduct extends Model
{
    protected $fillable = [
        "supplier_offer_id",
        "product_id",
        "price",
        "quantity",
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, "product_id");
    }
}

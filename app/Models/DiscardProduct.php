<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DiscardProduct
 *
 * @property int $id
 * @property int $discard_id
 * @property int $product_id
 * @property int $quantity
 * @property string $price
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\SupplierDiscard $discard
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|DiscardProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DiscardProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DiscardProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|DiscardProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscardProduct whereDiscardId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscardProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscardProduct wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscardProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscardProduct whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscardProduct whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscardProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DiscardProduct extends Model
{
    protected $guarded = ["id"];

    public function product()
    {
        return $this->belongsTo(Product::class, "product_id");
    }

    public function discard()
    {
        return $this->belongsTo(SupplierDiscard::class, "discard_id");
    }
}

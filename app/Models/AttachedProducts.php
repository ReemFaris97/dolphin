<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AttachedProducts
 *
 * @property int $id
 * @property int $quantity
 * @property string|null $price
 * @property string $model_type
 * @property int $model_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $product_id
 * @property int|null $transaction_id
 * @property-read Model|\Eloquent $model
 * @property-read Product|null $product
 * @property-read \App\Models\Store $store
 * @method static \Illuminate\Database\Eloquent\Builder|AttachedProducts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttachedProducts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttachedProducts query()
 * @method static \Illuminate\Database\Eloquent\Builder|AttachedProducts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttachedProducts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttachedProducts whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttachedProducts whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttachedProducts wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttachedProducts whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttachedProducts whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttachedProducts whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttachedProducts whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AttachedProducts extends Model
{
    protected $fillable = ['quantity', 'price', 'product_id', 'transaction_id', 'store_id'];

    public function model()
    {
        return $this->morphTo();
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id')->withDefault('product_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function getPriceAttribute()
    {
        if ($this->model_type==RouteTripReport::class && $this->model->is_packages) {
            return $this->attributes['price'] * $this->product->quantity_per_unit;
        }
        return $this->attributes['price'];
    }

    public function getQuantityAttribute()
    {
        if ($this->model_type==RouteTripReport::class && $this->model->is_packages) {
            return $this->attributes['quantity'] / $this->product->quantity_per_unit;
        }
        return $this->attributes['quantity'];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SupplierPrice
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property string $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $expired_at
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierPrice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierPrice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierPrice query()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierPrice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierPrice whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierPrice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierPrice wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierPrice whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierPrice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierPrice whereUserId($value)
 * @mixin \Eloquent
 */
class SupplierPrice extends Model
{
    protected $fillable =['user_id','product_id','price','expired_at'];

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}

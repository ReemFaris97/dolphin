<?php
declare(strict_types=1);

namespace App\Models\AccountingSystem;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingProductStore
 *
 * @property int $id
 * @property int|null $store_id
 * @property int|null $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $quantity
 * @property int|null $bond_id
 * @property int $is_active
 * @property int|null $unit_id
 * @property-read \App\Models\AccountingSystem\AccountingProduct|null $product
 * @property-read \App\Models\AccountingSystem\AccountingStore|null $store
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStore newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStore newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStore query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStore whereBondId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStore whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStore whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStore whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStore whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStore whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStore whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStore whereUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStore whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingProductStore extends Model
{
    protected $fillable = ['product_id','store_id','quantity','bond_id','is_active','unit_id','price'];

    public function product()
    {
        return $this->belongsTo(AccountingProduct::class, 'product_id');
    }
    public function store()
    {
        return $this->belongsTo(AccountingStore::class, 'store_id');
    }
    public function unit()
    {
        return $this->belongsTo(AccountingProductSubUnit::class, 'unit_id');
    }
}

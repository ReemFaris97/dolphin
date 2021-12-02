<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\Models\AccountingSystem\AccountingProductSubUnit
 *
 * @property int $id
 * @property int|null $product_id
 * @property string|null $name
 * @property string|null $bar_code
 * @property string|null $main_unit_present
 * @property string|null $selling_price
 * @property string|null $purchasing_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $quantity
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductSubUnit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductSubUnit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductSubUnit query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductSubUnit whereBarCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductSubUnit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductSubUnit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductSubUnit whereMainUnitPresent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductSubUnit whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductSubUnit whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductSubUnit wherePurchasingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductSubUnit whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductSubUnit whereSellingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductSubUnit whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingProductSubUnit extends Model
{
    protected $table='accounting_products_subUnits';
    protected $fillable = ['name','product_id','bar_code','main_unit_present','selling_price','purchasing_price','quantity'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'bar_code' => 'array',
    ];
    public function scopeOfBarcode($query, $barcode=null)
    {
        if ($barcode!=null) {
            $query->whereJsonContains('bar_code', (string) $barcode);
        }
    }
}

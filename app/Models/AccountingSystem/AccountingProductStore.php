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

    /**
     * add product to store
     *
     * @param integer $product_id
     * @param integer $quantity
     * @param integer|null $unit_id
     * @param integer $store_id
     * @param float $price
     * @param integer|null $bond_id
     * @return self
     */
    public static function addQuantity(int $product_id, int $quantity, ?int $unit_id=null, int $store_id, float $price, ?int $bond_id=null):self
    {
        $main_unit_id=  AccountingProductSubUnit::where('id', $unit_id)->value('main_unit_present')??1;
        $quantity_in_main_unit=$quantity*$main_unit_id;
        $price=$price/$main_unit_id;
        return   self::create([
            'product_id'=>$product_id,
            'store_id'=>$store_id,
            'quantity'=>$quantity_in_main_unit,
            'bond_id'=>$bond_id,
            'is_active'=>1,
            'unit_id'=>null,
            'price'=>$price
        ]);
    }

    /**
     * sub product to store
     *
     * @param integer $product_id
     * @param integer $quantity
     * @param integer|null $unit_id
     * @param integer $store_id
     * @param float $price
     * @param integer|null $bond_id
     * @return self
     */
    public function subQuantity(int $quantity, ?int $unit_id=null):void
    {
        $main_unit_id=  AccountingProductSubUnit::where('id', $unit_id)->value('main_unit_present')??1;
        $quantity_in_main_unit=$quantity*$main_unit_id;
        $this->update([
            'quantity'=>$this->quantity-$quantity_in_main_unit,
        ]);
    }
}

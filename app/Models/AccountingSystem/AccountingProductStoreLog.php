<?php

namespace App\Models\AccountingSystem;

use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingProductStore;
use App\Models\AccountingSystem\AccountingProductSubUnit;
use App\Models\AccountingSystem\AccountingStore;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingProductStoreLog
 *
 * @property int $id
 * @property int|null $accounting_product_store_id
 * @property int|null $accounting_product_id
 * @property int|null $unit_id
 * @property string $dispatcher_type
 * @property int $dispatcher_id
 * @property string|null $price
 * @property int|null $amount
 * @property string|null $type
 * @property int|null $amount_by_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $dispatcher
 * @property-read AccountingProduct|null $product
 * @property-read AccountingProductStore|null $product_store
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStoreLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStoreLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStoreLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStoreLog whereAccountingProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStoreLog whereAccountingProductStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStoreLog whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStoreLog whereAmountByType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStoreLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStoreLog whereDispatcherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStoreLog whereDispatcherType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStoreLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStoreLog wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStoreLog whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStoreLog whereUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStoreLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingProductStoreLog extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        parent::booted();

        
        static::created(function ($log) {
            if ($log->product_store==null) {
                AccountingProductStore::firstOrCreate(
                    [
            'product_id'=>$log->product_id,
            'store_id'=>request()->store_id??AccountingStore::first()->id,
        ],
                    ['quantity'=>0]
                )->id;
            }
            $log->type=='in'? $log->product_store?->increment('quantity', $log->amount):$log->product_store?->decrement('quantity', $log->amount);
        });
    }
    public function product()
    {
        return $this->belongsTo(AccountingProduct::class, 'accounting_product_id');
    }

    public function product_store()
    {
        return $this->belongsTo(AccountingProductStore::class, 'accounting_product_store_id');
    }
    public function dispatcher()
    {
        return $this->morphTo('dispatcher');
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
    public function addQuantity(int $product_id, int $quantity, ?int $unit_id=null, int $store_id, float $price, ?int $bond_id=null):self
    {
        $main_unit_id=  AccountingProductSubUnit::where('id', $unit_id)->value('main_unit_present')??1;
        $quantity_in_main_unit=$quantity*$main_unit_id;
        $price=$price/$main_unit_id;
        
        $product_store_id=AccountingProductStore::firstOrCreate(
            [
                'product_id'=>$product_id,
                'store_id'=>$store_id,
            ],
            [
                'quantity'=>$quantity_in_main_unit
            ]
        )->id;
        $log= $this->fill([
            'accounting_product_store_id'=>$product_store_id,
            'accounting_product_id'=>$product_id,
            'unit_id'=>null,
        
            'price'=>$price,
            'amount'=>$quantity_in_main_unit,
            'type'=>'in',
        ]);
        $log->save();
        return $log;
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

<?php

namespace App\Models\Models\AccountingSystem;

use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingProductStore;
use App\Models\AccountingSystem\AccountingProductSubUnit;
use App\Models\AccountingSystem\AccountingStore;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
            'expired_at'=>$log->expired_at,
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

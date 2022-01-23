<?php

namespace App\Models\AccountingSystem;

use App\Models\Models\AccountingSystem\AccountingProductStoreLog;
use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * App\Models\AccountingSystem\AccountingPurchaseReturnItem
 *
 * @property int $id
 * @property int|null $purchase_return_id
 * @property int|null $product_id
 * @property int|null $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $unit_type
 * @property string|null $price
 * @property string|null $tax
 * @property string|null $price_after_tax
 * @property int|null $unit_id
 * @property string|null $gifts
 * @property-read \App\Models\AccountingSystem\AccountingProduct|null $product
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturnItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturnItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturnItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturnItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturnItem whereGifts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturnItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturnItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturnItem wherePriceAfterTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturnItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturnItem wherePurchaseReturnId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturnItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturnItem whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturnItem whereUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturnItem whereUnitType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturnItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingPurchaseReturnItem extends Model
{
    protected $fillable = ['product_id','quantity','purchase_return_id','price','unit_id','tax','price_after_tax','unit_type','gifts','expired_at'];
    protected $table='accounting_purchase_return_items';


    public static function booted()
    {
        static::created(function (AccountingPurchaseReturnItem $item) {
            $item->subQuantityToStorage();
        });
    }
    public function product()
    {
        return $this->belongsTo(AccountingProduct::class, 'product_id');
    }
    public function purchase()
    {
        return $this->belongsTo(AccountingPurchaseReturn::class, 'purchase_return_id');
    }
    public function unit()
    {
        return $this->belongsTo(AccountingProductSubUnit::class, 'unit_id');
    }
    /**
    * @return MorphMany
    */
    public function store_quantity_log():MorphMany
    {
        return $this->morphMany(AccountingProductStoreLog::class, 'dispatcher');
    }




    public function allDiscounts()
    {
        // return $this->hasMany(AccountingItemDiscount::class,'item_id');
        $discounts=AccountingItemDiscount::where('item_id', $this->id)->where('type', 'return')->get();
        return $discounts;
    }

    public function discount()
    {
        $discounts=AccountingItemDiscount::where('item_id', $this->id)->where('type', 'return')->get();
        $total=[];
        $total['percentage']=0;
        $total['amount']=0;
        foreach ($discounts as $discount) {
            if ($discount->discount_type=='percentage') {
                $total['percentage']+=$discount->discount;
            } else {
                $total['amount']+=$discount->discount;
            }
        }

        return $total;
    }

    
    // handling qunaitities

    /**
     * Undocumented function
     *
     * @return Collection
     */
    public function subQuantityToStorage():Collection
    {
        $storage=[$this->getStorageQuantity()];
        ($this->gifts!=0)?array_push($storage, $this->getGiftsQuantity()):null;
        return $this->store_quantity_log()->createMany($storage);
    }


    public function getProductStoreId():int
    {
        return   AccountingProductStore::query()
        ->where('product_id', $this->product_id)
        ->where('store_id', $this->purchase->store_id)
        ->where('expired_at', $this->expired_at)->first(['id'])
        ->id;
    }
    public function getQuantityInMainUnitAttribute():int
    {
        return ($this->unit?->main_unit_present??1) *$this->quantity;
    }

    public function getGiftInMainUnitAttribute():int
    {
        return ($this->unit?->main_unit_present??1) *$this->gifts;
    }

    public function getPriceForMainUnitAttribute():float
    {
        return  $this->price / ($this->unit?->main_unit_present??1);
    }

    
    /**
     * convert quantity  to product store log
     *
     * @return array
     */
    public function getStorageQuantity():array
    {
        return [
            'accounting_product_store_id'=>$this->getProductStoreId(),
            'accounting_product_id'=>$this->product_id,
            'unit_id'=>null,
            'expired_at'=>$this->expired_at,
            'price'=>$this->getPriceForMainUnitAttribute(),
            'amount'=>$this->getQuantityInMainUnitAttribute(),
            'type'=>'out',
        ];
    }

    /**
     * convert gift amount to product store log
     *
     * @return array
     */
    public function getGiftsQuantity():array
    {
        return [
            'accounting_product_store_id'=>$this->getProductStoreId(),
            'accounting_product_id'=>$this->product_id,
            'unit_id'=>null,
            'price'=>0,
            'expired_at'=>$this->expired_at,
            'amount'=>$this->getGiftInMainUnitAttribute(),
            'type'=>'out',
        ];
    }
}

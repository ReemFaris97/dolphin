<?php

namespace App\Models\AccountingSystem;

use App\Models\Models\AccountingSystem\AccountingProductStoreLog;
use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\AccountingSystem\AccountingPurchaseItem
 *
 * @property int $id
 * @property int|null $purchase_id
 * @property int|null $product_id
 * @property integer|null $quantity
 * @property string|null $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $unit_id
 * @property float|null $tax
 * @property float|null $price_after_tax
 * @property string|null $unit_type
 * @property string|null $expire_date
 * @property string|null $gifts
 * @property-read \App\Models\AccountingSystem\AccountingProduct|null $product
 * @property-read \App\Models\AccountingSystem\AccountingPurchase|null $purchase
 * @property-read \App\Models\AccountingSystem\AccountingProductSubUnit|null $unit
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseItem whereExpireDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseItem whereGifts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseItem wherePriceAfterTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseItem wherePurchaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseItem whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseItem whereUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseItem whereUnitType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingPurchaseItem extends Model
{
    protected $fillable = ['product_id','quantity','price','purchase_id','purchase_return_id','tax','unit_id','price_after_tax','unit_type','expire_date','gifts'];
    protected $table='accounting_purchases_items';

    protected static function booted()
    {
        static::created(function (AccountingPurchaseItem $item) {
            $item->addQuantityToStorage();
        });
    }

    public function product()
    {
        return $this->belongsTo(AccountingProduct::class, 'product_id');
    }
    public function discounts()
    {
        return $this->hasMany(AccountingItemDiscount::class, 'item_id')->where('type', 'purchase');
    }

    public function discounts_amount()
    {
        return $this->hasMany(AccountingItemDiscount::class, 'item_id')
        ->where('type', 'purchase')
        ->where('discount_type', 'percentage');
    }


    public function discounts_percent()
    {
        return $this->hasMany(AccountingItemDiscount::class, 'item_id')
        ->where('type', 'purchase')
        ->where('discount_type', 'percentage');
    }

    public function purchase()
    {
        return $this->belongsTo(AccountingPurchase::class, 'purchase_id');
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

    public function units()
    {
//        return $this->belongsTo(AccountingProductSubUnit::class,'unit_id');

        $units=AccountingProductSubUnit::where('product_id', $this->product->id)->get();
        $subunits= collect($units);
        $allunits=json_encode($subunits, JSON_UNESCAPED_UNICODE);
        $mainunits=json_encode(collect([['id'=>'main-'.$this->product->id,'name'=>$this->product->main_unit , 'purchasing_price'=>$this->product->purchasing_price]]), JSON_UNESCAPED_UNICODE);
        $merged = array_merge(json_decode($mainunits), json_decode($allunits));

        return $merged;
    }


    public function allDiscounts()
    {
        // return $this->hasMany(AccountingItemDiscount::class,'item_id');
        $discounts=AccountingItemDiscount::where('item_id', $this->id)->where('type', 'purchase')->get();
        return $discounts;
    }


    public function discount()
    {
        $discounts=AccountingItemDiscount::where('item_id', $this->id)->where('type', 'purchase')->get();
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
    public function addQuantityToStorage():Collection
    {
        $storage=[$this->getStorageQuantity()];
        ($this->gifts!=0)?array_push($storage, $this->getGiftsQuantity()):null;
        return $this->store_quantity_log()->createMany($storage);
    }


    public function getProductStoreId():int
    {
        return   AccountingProductStore::firstOrCreate(
            [
                'product_id'=>$this->product_id,
                'store_id'=>$this->purchase->store_id,
            ],
            ['quantity'=>0]
        )->id;
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
            'price'=>$this->getPriceForMainUnitAttribute(),
            'amount'=>$this->getQuantityInMainUnitAttribute(),
            'type'=>'in',
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
            'amount'=>$this->getGiftInMainUnitAttribute(),
            'type'=>'in',
        ];
    }

    public function scopeInPeriod(Builder $query, $start, $end):void
    {
        $query->whereBetween(DB::raw('DATE(created_at)'), [$start, $end]);
    }

    public function getTotalItemDiscountAttribute()
    {
        $amount= $this->discounts_amount()->sum('discount');
   
        $total_discount_percent=$this->discounts_percent()->sum('discount');
        $amount+= $this->price *($total_discount_percent/100);
        return $amount;
    }
}

<?php

namespace App\Models\AccountingSystem;

use App\Models\Models\AccountingSystem\AccountingProductStoreLog;
use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\AccountingSystem\AccountingSaleItem
 *
 * @property int $id
 * @property int|null $sale_id
 * @property int|null $product_id
 * @property string|null $quantity
 * @property string|null $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $unit_id
 * @property string|null $unit_type
 * @property string|null $price_after_tax
 * @property string|null $tax
 * @property-read \App\Models\AccountingSystem\AccountingProduct|null $product
 * @property-read \App\Models\AccountingSystem\AccountingSale|null $sale
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSaleItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSaleItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSaleItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSaleItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSaleItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSaleItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSaleItem wherePriceAfterTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSaleItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSaleItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSaleItem whereSaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSaleItem whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSaleItem whereUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSaleItem whereUnitType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSaleItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingSaleItem extends Model
{
    protected $fillable = ['product_id','quantity','price','sale_id','price_after_tax','tax','unit_id'];
    protected $table='accounting_sales_items';

    protected static function booted()
    {
        static::created(function (AccountingSaleItem $item) {
            $item->subQuantity();
        });
    }
    public function product()
    {
        return $this->belongsTo(AccountingProduct::class, 'product_id');
    }
    public function sale()
    {
        return $this->belongsTo(AccountingSale::class, 'sale_id');
    }

    public function priceWithoutTax($tax)
    {
        return ($this->price*100/(100+$tax));
    }
    public function getTax($tax)
    {
        return $this->price-($this->price*100/(100+$tax));
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
    public function subQuantity():AccountingProductStoreLog
    {
        $main_unit=  AccountingProductSubUnit::where('id', $this->unit_id)->value('main_unit_present')??1;
        $quantity_in_main_unit=$this->quantity*$main_unit;
        $price=$this->price/$main_unit;
        $product_store_id=AccountingProductStore::where('product_id', $this->product_id)->where('store_id', $this->sale->store_id)->value('id');
        return $this->store_quantity_log()->create(
            [
                'accounting_product_store_id'=>$product_store_id,
                'accounting_product_id'=>$this->product_id,
                'unit_id'=>null,
                'price'=>$price,
                'amount'=>$quantity_in_main_unit,
                'type'=>'out',
            ]
        );
    }
    public function scopeInPeriod($query, $start, $end):void
    {
        $query->whereBetween(DB::raw('DATE(created_at)'), [$start, $end]);
    }
}

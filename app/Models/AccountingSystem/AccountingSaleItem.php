<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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


    protected $fillable = ['product_id','quantity','price','sale_id','price_after_tax','tax'];
    protected $table='accounting_sales_items';

    public function product()
    {
        return $this->belongsTo(AccountingProduct::class,'product_id');
    }
    public function sale()
    {
        return $this->belongsTo(AccountingSale::class,'sale_id');
    }

    public function units()
    {
//        return $this->belongsTo(AccountingProductSubUnit::class,'unit_id');

        $units=AccountingProductSubUnit::where('product_id',$this->product->id)->get();
        $subunits= collect($units);
        $allunits=json_encode($subunits,JSON_UNESCAPED_UNICODE);
        $mainunits=json_encode(collect([['id'=>'main-'.$this->product->id,'name'=>$this->product->main_unit , 'purchasing_price'=>$this->product->purchasing_price]]),JSON_UNESCAPED_UNICODE);
        $merged = array_merge(json_decode($mainunits), json_decode($allunits));

        return $merged;

    }

}

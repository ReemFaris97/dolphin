<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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


    protected $fillable = ['product_id','quantity','purchase_return_id','price','unit_id','tax','price_after_tax','unit_type','gifts'];
    protected $table='accounting_purchase_return_items';

    public function product()
    {
        return $this->belongsTo(AccountingProduct::class,'product_id');
    }



    public  function  allDiscounts(){
        // return $this->hasMany(AccountingItemDiscount::class,'item_id');
        $discounts=AccountingItemDiscount::where('item_id',$this->id)->where('type','return')->get();
          return $discounts;
    }

    public function discount(){
        $discounts=AccountingItemDiscount::where('item_id',$this->id)->where('type','return')->get();
        $total=[];
        $total['percentage']=0;
        $total['amount']=0;
        foreach($discounts as $discount){

            if($discount->discount_type=='percentage'){
             $total['percentage']+=$discount->discount;
            }else{
            $total['amount']+=$discount->discount;
            }
        }

        return $total;
    }
}

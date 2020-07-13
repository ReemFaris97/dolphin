<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingPurchaseItem extends Model
{


    protected $fillable = ['product_id','quantity','price','purchase_id','purchase_return_id','tax','unit_id','price_after_tax','unit_type','expire_date'];
    protected $table='accounting_purchases_items';


    public function product()
    {
        return $this->belongsTo(AccountingProduct::class,'product_id');
    }

    public function purchase()
    {

        return $this->belongsTo(AccountingPurchase::class,'purchase_id');
    }

    public function unit()
    {
       return $this->belongsTo(AccountingProductSubUnit::class,'unit_id');


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


    public  function  allDiscounts(){
        return $this->hasMany(AccountingItemDiscount::class,'item_id');

    }


    public function discount(){
        $discounts=AccountingItemDiscount::where('item_id',$this->id)->get();
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

<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

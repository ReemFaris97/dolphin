<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingPurchaseItem extends Model
{


    protected $fillable = ['product_id','quantity','price','purchase_id','purchase_return_id','tax','unit_id','price_after_tax','unit_type'];
    protected $table='accounting_purchases_items';


    public function product()
    {
        return $this->belongsTo(AccountingProduct::class,'product_id');
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

<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingSaleItem extends Model
{


    protected $fillable = ['product_id','quantity','price','sale_id'];
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

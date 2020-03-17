<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingProduct extends Model
{
    protected $fillable = ['name','description','type','is_active','category_id',
    'column_id','bar_code','main_unit','selling_price','purchasing_price','min_quantity',
    'max_quantity','expired_at','image'
    ,'size','color','height','width','num_days_recession','industrial_id','quantity','unit_price',
    'is_settlement','date_settlement','settlement_store_id','cell_id','alert_duration'
];
protected $appends = ['total_taxes','total_discounts'];
    public function store()
    {
        return $this->belongsTo(AccountingStore::class,'store_id');
    }
    public function storeSettlement()
    {
        return $this->belongsTo(AccountingStore::class,'settlement_store_id');
    }
    public function category()
    {
        return $this->belongsTo(AccountingProductCategory::class,'category_id');
    }

    public function cell()
    {
        return $this->belongsTo(AccountingColumnCell::class,'cell_id');
    }

    public function getTotalTaxesAttribute()
    {
        $taxs=AccountingProductTax::where('product_id',$this->id)->get();
        $total = 0;
        foreach($taxs as $tax){
            $total+=$tax->Taxband->percent;
        }
        return $total;
    }


    public function getTotalDiscountsAttribute()
    {
        $discounts=AccountingProductDiscount::where('product_id',$this->id)->get();
        $total = 0;
        foreach($discounts as $discount){
            $total+=$discount->percent;
        }
        return $total;
    }
}


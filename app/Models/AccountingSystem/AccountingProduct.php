<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingProduct extends Model
{
    protected $fillable = ['name','description','type','is_active','category_id',
    'column_id','bar_code','main_unit','selling_price','purchasing_price','min_quantity',
    'max_quantity','expired_at','image'
    ,'size','color','height','width','num_days_recession','industrial_id','quantity','unit_price',
    'is_settlement','date_settlement','settlement_store_id','cell_id','alert_duration','supplier_id','account_id'

];
    protected $appends = ['total_taxes','total_discounts'];
    public function cell_product()
    {
        return $this->belongsTo(AccountingColumnCell::class,'cell_id');
    }
    public function cell()
    {
        return $this->belongsTo(AccountingColumnCell::class,'cell_id');
    }
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



    public function getTotalTaxesAttribute()
    {
        $taxs=AccountingProductTax::where('product_id',$this->id)->get();
        $total = 0;
        foreach($taxs as $tax){
            $total+=optional($tax->Taxband)->percent;
        }
        return $total;
    }

    public function getTotalQuantities()
    {
        $units=AccountingProductSubUnit::where('product_id',$this->id)->get();
        $totalQuantity = 0;
        foreach($units as $unit){
            $totalQuantity+=$unit->quantity*$unit->main_unit_present;
        }
        return $totalQuantity+$this->quantity;
    }


    public function account()
    {
        return $this->belongsTo(AccountingAccount::class,'account_id');
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

//    public function getDiscountTypeAttribute()
//    {
//        $discount=AccountingProductDiscount::where('product_id',$this->id)->first();
//
//        return $discount->discount_type;
//    }
//
//    public function getPercentAttribute()
//    {
//        $discount = AccountingProductDiscount::where('product_id', $this->id)->first();
//
//
//        return $discount->percent;
//    }
    public function items()
    {
        return $this->hasMany(AccountingSaleItem::class,'product_id');
    }


    public function quantity()
    {
        return $this->hasMany(AccountingProductStore::class,'product_id')->sum('quantity');
    }
    public function sold_items()
    {
        return $this->hasManyThrough(AccountingSale::class,
            AccountingSaleItem::class,
            'product_id',
            'sale_id')->latest();
    }

    public function sales()
    {
        return $this->hasMany(AccountingSaleItem::class)->whereHas('sale', function ($q) {
            $q->where('store_id',1);
        });
    }






   }


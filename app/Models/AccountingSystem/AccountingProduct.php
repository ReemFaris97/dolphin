<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingProduct extends Model
{
    protected $fillable = ['name','description','type','is_active','category_id','cell_id','bar_code','main_unit','selling_price','purchasing_price','min_quantity','max_quantity','expired_at','image'
    ,'size','color','height','width','num_days_recession'];


    public function store()
    {
        return $this->belongsTo(AccountingStore::class,'store_id');
    }
    public function category()
    {
        return $this->belongsTo(AccountingProductCategory::class,'category_id');
    }
}

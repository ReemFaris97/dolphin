<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingSale extends Model
{


    protected $fillable = ['client_id','total','amount','discount','payment','payed','debts','package_id','session_id','branch_id','company_id','store_id','bill_num','totalTaxs'
     ,'status','user_id','cash','network','discount_type','counter','daily_number','counter_sale','date','account_id' ];
    protected $table='accounting_sales';
    protected $appends = ['item_cost'];
    public function client()
    {
        return $this->belongsTo(AccountingClient::class,'client_id');
    }
    public function session()
    {
        return $this->belongsTo(AccountingSession::class,'session_id');
    }

    public function company()
    {
        return $this->belongsTo(AccountingCompany::class,'company_id');
    }
    public function branch()
    {
        return $this->belongsTo(AccountingBranch::class,'branch_id');
    }

    public function store()
    {
        return $this->belongsTo(AccountingStore::class,'store_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function items()
    {
        return $this->hasMany(AccountingSaleItem::class, 'sale_id');
    }

    public function getItemCostAttribute()
    {
        $products_item=AccountingSaleItem::where('sale_id',$this->id)->pluck('product_id','quantity')->toArray();


        $cost=0;
        foreach ($products_item as $key=>$product_id){
            $product=AccountingProduct::find($product_id);
            $cost+=$product->purchasing_price * $key;

        }

        return $cost;
    }
}

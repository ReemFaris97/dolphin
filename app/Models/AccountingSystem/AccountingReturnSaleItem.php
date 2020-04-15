<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingReturnSaleItem extends Model
{


    protected $fillable = ['sale_return_id','product_id','quantity','price','unit_id','unit_type'];
    protected $table='accounting_sales_returns_item';


    public function sale()
    {
        return $this->belongsTo(AccountingReturnSaleItem::class,'sale_return_id');
    }


}


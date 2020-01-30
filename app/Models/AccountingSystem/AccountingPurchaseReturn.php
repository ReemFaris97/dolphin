<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingPurchaseReturn extends Model
{


    protected $fillable = ['product_id','quantity','purchase_id'];
    protected $table='accounting_purchases_returns';


    public function supplier()
    {
        return $this->belongsTo(AccountingSupplier::class,'supplier_id');
    }

    public function session()
    {
        return $this->belongsTo(AccountingSession::class,'session_id');
    }

    public function safe()
    {
        return $this->belongsTo(AccountingSafe::class,'safe_id');
    }

    public function company()
    {
        return $this->belongsTo(AccountingCompany::class,'company_id');
    }
  
}

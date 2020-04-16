<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingSupplierLog extends Model
{


    protected $fillable = ['supplier_id','purchase_id','clause_id','status','amount'
 ];
    protected $table='accounting_supplier_log';


    public  function  purchase(){
        return $this->belongsTo(AccountingPurchase::class, 'purchase_id');
    }

    public  function  supplier(){
        return $this->belongsTo(AccountingSupplier::class, 'supplier_id');

    }
    public  function  clause(){
        return $this->belongsTo(AccountingMoneyClause::class, 'clause_id');
    }
}


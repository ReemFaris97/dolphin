<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingSupplierCompany extends Model
{


    protected $fillable = ['supplier_id','company_id',
 ];
    protected $table='accounting_suppliers_companies';


    public  function  company(){
        return $this->belongsTo(AccountingCompany::class, 'company_id');

    }

    public  function  supplier(){
        return $this->belongsTo(AccountingSupplier::class, 'supplier_id');

    }
}


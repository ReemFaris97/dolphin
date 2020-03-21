<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingSupplier extends Model
{


    protected $fillable = ['name','email','phone','credit','branch_id','amount','password','image','bank_id',
        'bank_account_number','tax_number','is_active','balance'
    ];
    protected $table='accounting_suppliers';


    public  function  companies(){
        return $this->hasMany(AccountingSupplierCompany::class, 'supplier_id');

    }


    public   function  balances(){

        $balance=AccountingPurchase::where('supplier_id',$this->id)->where('payment','agel')->sum('total');

        return $balance;
    }
}

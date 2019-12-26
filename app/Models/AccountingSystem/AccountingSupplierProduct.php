<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingSupplierProduct extends Model
{


    protected $fillable = ['supplier_id','product_id'
    ];
    protected $table='accounting_suppliers_products';




}

<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingDelegateProduct extends Model
{


    protected $fillable = ['delegate_id','product_id'
    ];
    protected $table='accounting_delegate_products';




}

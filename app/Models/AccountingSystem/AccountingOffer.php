<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingOffer extends Model
{


    protected $fillable = ['product_id','quantity','price','package_id'
    ];
    protected $table='accounting_clients';

}

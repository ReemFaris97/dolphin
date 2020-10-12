<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingCurrency extends Model
{


    protected $fillable = ['ar_name','en_name',
 ];
    protected $table='accounting_currencies';


}


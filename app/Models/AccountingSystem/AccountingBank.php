<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingBank extends Model
{


    protected $fillable = ['name','bank_account_number',
 ];
    protected $table='accounting_banks';


}


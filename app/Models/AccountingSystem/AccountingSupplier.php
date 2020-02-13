<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingSupplier extends Model
{


    protected $fillable = ['name','email','phone','credit','branch_id','amount'
    ];
    protected $table='accounting_suppliers';


}

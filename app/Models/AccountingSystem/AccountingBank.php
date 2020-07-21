<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingBank extends Model
{


    protected $fillable = ['name','bank_number','en_name','account_name','account_num','currency_id','active','notes'];
    protected $table='accounting_banks';
    public function currency()
    {
        return $this->belongsTo(AccountingCurrency::class,'currency_id');
    }

}


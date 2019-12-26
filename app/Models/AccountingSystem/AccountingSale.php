<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingSale extends Model
{


    protected $fillable = ['client_id','total','amount','discount','payment','payed','debts','package_id'];
    protected $table='accounting_sales';



    public function client()
    {
        return $this->belongsTo(AccountingClient::class,'client_id');
    }
}

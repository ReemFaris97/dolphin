<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingPackage extends Model
{


    protected $fillable = ['client_id','total'
    ];
    protected $table='accounting_packages';


    public  function offers(){
        return $this->hasMany(AccountingOffer::class,'package_id');

    }
}

<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingNotifiaction extends Model
{


    protected $fillable =['client_id','package_id','read_at'
    ];
    protected $table='accounting_notifactions';

}

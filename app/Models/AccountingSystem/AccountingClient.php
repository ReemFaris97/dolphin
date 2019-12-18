<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingClient extends Model
{


    protected $fillable = ['name','email','phone','fax','category','tax_number','commercial_registration_no','type_price','type_bills'];
    protected $table='accounting_clients';

}

<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingBond extends Model
{


    protected $fillable = ['user_id','store_id','bond_num','date','description','type','total_price'];
    protected $table='accounting_bonds';


}

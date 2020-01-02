<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingIndustrial extends Model
{



    protected $fillable = [ 'name'];
    protected $table='accounting_product_industrials';

}

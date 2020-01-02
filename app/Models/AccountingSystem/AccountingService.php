<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingService extends Model
{
    use SoftDeletes;
    protected $fillable = ['product_id','code','price','type'];
}

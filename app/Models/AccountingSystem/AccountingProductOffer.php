<?php

namespace App\Models\AccountingSystem;


use Illuminate\Database\Eloquent\Model;

class AccountingProductOffer extends Model
{
    protected  $table='accounting_product_offers';
    protected $fillable = ['parent_product_id','child_product_id'];
}

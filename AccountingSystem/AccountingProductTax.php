<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingProductTax extends Model
{
    protected $fillable = [ 'product_id','tax','price_has_tax','tax_value'];

protected $table='accounting_product_taxes';
}

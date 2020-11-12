<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingProductBarcode extends Model
{


    protected $fillable = ['product_id','barcode'];
    protected $table='accounting_products_barcodes';

}


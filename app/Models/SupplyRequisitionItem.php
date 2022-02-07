<?php

namespace App\Models;

use App\Models\AccountingSystem\AccountingProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplyRequisitionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        "supply_requisition_id",
        "accounting_product_id",
        "unit",
        "quantity",
    ];

    public function product()
    {
        return $this->belongsTo(
            AccountingProduct::class,
            "accounting_product_id"
        );
    }
}

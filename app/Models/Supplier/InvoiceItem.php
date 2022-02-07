<?php

namespace App\Models\Supplier;

use App\Models\AccountingSystem\AccountingProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;
    protected $table = "suppliers_invoice_items";
    protected $fillable = [
        "invoice_id",
        "accounting_product_id",
        "unit",
        "price",
        "quantity",
        "expire_at",
    ];

    public function accountingProduct()
    {
        return $this->belongsTo(AccountingProduct::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}

<?php

namespace App\Models\Supplier;

use App\Models\AccountingSystem\AccountingCompany;
use App\Models\AccountingSystem\AccountingSupplier;
use App\Traits\HasImages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "suppliers_products";
    use HasFactory, HasImages;

    protected $images = ["image"];
    protected $fillable = [
        "name",
        "barcode",
        "unit",
        "notes",
        "price",
        "expire_at",
        "image",
        "is_active",
        "accounting_supplier_id",
        "accounting_company_id",
    ];

    public function supplier()
    {
        return $this->belongsTo(AccountingSupplier::class);
    }

    public function company()
    {
        return $this->belongsTo(AccountingCompany::class);
    }
}

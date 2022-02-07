<?php

namespace App\Models\Supplier;

use App\Models\AccountingSystem\AccountingSupplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $table = "suppliers_banks";
    protected $fillable = [
        "name",
        "iban",
        "owner_name",
        "accounting_supplier_id",
    ];

    public function supplier()
    {
        return $this->belongsTo(
            AccountingSupplier::class,
            "accounting_supplier_id"
        );
    }
}

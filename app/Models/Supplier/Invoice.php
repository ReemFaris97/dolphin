<?php

namespace App\Models\Supplier;

use App\Models\AccountingSystem\AccountingSupplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'suppliers_invoices';
    protected $fillable = ['accounting_supplier_id'];

    public function AccountingSupplier()
    {
        return $this->belongsTo(AccountingSupplier::class);
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}

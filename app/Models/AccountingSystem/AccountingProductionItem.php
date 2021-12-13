<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingProductionItem extends Model
{
    use HasFactory;
    protected $table = 'accounting_production_items';
    protected $fillable = ['production_id', 'product_id','unit_id','quantity'];

    public function production()
    {
        return $this->belongsTo(AccountingProduction::class, 'production_id');
    }

    public function product()
    {
        return $this->belongsTo(AccountingProduct::class, 'product_id');
    }

    public function unit()
    {
        return $this->belongsTo( AccountingProductMainUnit::class, 'unit_id');
    }


}

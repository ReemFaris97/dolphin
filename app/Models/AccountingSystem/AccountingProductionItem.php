<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingProductionItem extends Model
{
    use HasFactory;
    protected $table = "accounting_production_items";
    protected $fillable = ["production_id", "recipe_id", "unit_id", "quantity"];

    public function production()
    {
        return $this->belongsTo(AccountingProduction::class, "production_id");
    }

    public function product_recipe()
    {
        return $this->belongsTo(AccountingProductRecipe::class, "recipe_id");
    }

    public function unit()
    {
        return $this->belongsTo(AccountingProductSubUnit::class, "unit_id");
    }
}

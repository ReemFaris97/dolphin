<?php

namespace App\Models;

use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingProductRecipe;
use App\Models\AccountingSystem\AccountingProductSubUnit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingProductRecipeItem extends Model
{
    use HasFactory;
    protected $table = "accounting_product_recipe_items";
    protected $fillable = ["product_id", "unit_id", "recipe_id", "quantity"];

    public function product()
    {
        return $this->belongsTo(AccountingProduct::class, "product_id");
    }

    public function unit()
    {
        return $this->belongsTo(AccountingProductSubUnit::class, "unit_id");
    }

    public function recipe()
    {
        return $this->belongsTo(AccountingProductRecipe::class, "recipe_id");
    }
}

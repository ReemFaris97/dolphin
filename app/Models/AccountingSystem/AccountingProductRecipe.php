<?php

namespace App\Models\AccountingSystem;

use App\Models\AccountingProductRecipeItem;
use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingProductMainUnit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingProductRecipe extends Model
{
    use HasFactory;
    protected $table = "accounting_product_recipes";
    protected $fillable = ["product_id", "unit_id"];

    public function product()
    {
        return $this->belongsTo(AccountingProduct::class, "product_id");
    }

    public function unit()
    {
        return $this->belongsTo(AccountingProductSubUnit::class, "unit_id");
    }

    public function items()
    {
        return $this->hasMany(AccountingProductRecipeItem::class, "recipe_id");
    }
}

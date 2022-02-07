<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingProductTax
 *
 * @property int $id
 * @property int|null $product_id
 * @property int|null $tax
 * @property int|null $price_has_tax
 * @property string|null $tax_value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $tax_band_id
 * @property-read \App\Models\AccountingSystem\AccountingTaxBand|null $Taxband
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductTax newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductTax newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductTax query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductTax whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductTax whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductTax wherePriceHasTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductTax whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductTax whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductTax whereTaxBandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductTax whereTaxValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductTax whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingProductTax extends Model
{
    protected $fillable = [
        "product_id",
        "tax",
        "price_has_tax",
        "tax_value",
        "tax_band_id",
    ];

    protected $table = "accounting_product_taxes";
    public function Taxband()
    {
        return $this->belongsTo(AccountingTaxBand::class, "tax");
    }
}

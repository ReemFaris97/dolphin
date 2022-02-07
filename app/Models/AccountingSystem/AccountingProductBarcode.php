<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingProductBarcode
 *
 * @property int $id
 * @property int $product_id
 * @property string|null $barcode
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductBarcode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductBarcode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductBarcode query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductBarcode whereBarcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductBarcode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductBarcode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductBarcode whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductBarcode whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingProductBarcode extends Model
{
    protected $fillable = ["product_id", "barcode"];
    protected $table = "accounting_products_barcodes";
}

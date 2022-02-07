<?php

namespace App\Models\AccountingSystem;

use App\Models\AccountingSystem\AccountingProductStoreLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Validation\ValidationException;

/**
 * App\Models\AccountingSystem\AccountingReturnSaleItem
 *
 * @property int $id
 * @property int|null $sale_return_id
 * @property int|null $product_id
 * @property string|null $quantity
 * @property string|null $price
 * @property int|null $unit_id
 * @property string|null $unit_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AccountingSystem\AccountingProduct|null $product
 * @property-read AccountingReturnSaleItem|null $sale
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem whereSaleReturnId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem whereUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem whereUnitType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingReturnSaleItem extends Model
{
    protected $fillable = [
        "sale_return_id",
        "product_id",
        "quantity",
        "price",
        "unit_id",
        "unit_type",
    ];
    protected $table = "accounting_sales_returns_item";

    protected static function booted()
    {
        static::created(function (AccountingReturnSaleItem $item) {
            $item->addQuantityToStorage();
        });
    }

    public function sale()
    {
        return $this->belongsTo(AccountingReturn::class, "sale_return_id");
    }

    public function unit()
    {
        return $this->belongsTo(AccountingProductSubUnit::class, "unit_id");
    }

    public function product()
    {
        return $this->belongsTo(AccountingProduct::class, "product_id");
    }

    /**
     * @return MorphMany
     */
    public function store_quantity_log(): MorphOne
    {
        return $this->morphOne(AccountingProductStoreLog::class, "dispatcher");
    }

    public function addQuantityToStorage(): AccountingProductStoreLog
    {
        $main_unit = $this->unit->main_unit_present ?? 1;
        $quantity_in_main_unit = $this->quantity * $main_unit;
        $price = $this->price / $main_unit;
        $product_store_id = AccountingProductStore::query()
            ->where("product_id", $this->product_id)
            ->where("store_id", $this->sale->store_id)
            ->value("id");

        // get the product form sale inovice
        $item = $this->sale->sale
            ->items()
            ->where("product_id", $this->product_id)
            ->first();
        if ($item === null) {
            toast("المنتج غير موجود بالفاتوره الشراء", "danger");
            throw ValidationException::withMessages([
                "product_Id" => "المنتج غير موجود بالفاتوره الشراء",
            ]);
        }

        $old_log = $item->store_quantity_log;

        return $this->store_quantity_log()->create([
            "accounting_product_store_id" => $product_store_id,
            "accounting_product_id" => $this->product_id,
            "unit_id" => null,
            "price" => $price,
            "amount" => $quantity_in_main_unit,
            "type" => "in",
            "expired_at" => $old_log?->expired_at,
        ]);
    }
}

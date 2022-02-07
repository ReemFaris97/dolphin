<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingTransaction
 *
 * @property int $id
 * @property int|null $store_form
 * @property int|null $store_to
 * @property int|null $product_id
 * @property int|null $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property float|null $cost
 * @property float|null $price
 * @property int|null $request_id
 * @property-read \App\Models\AccountingSystem\AccountingProduct|null $product
 * @property-read \App\Models\AccountingSystem\AccountingSroreRequest|null $request
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransaction whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransaction wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransaction whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransaction whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransaction whereRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransaction whereStoreForm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransaction whereStoreTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransaction whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingTransaction extends Model
{
    protected $table = "accounting_transactions";
    protected $fillable = [
        "product_id",
        "request_id",
        "quantity",
        "cost",
        "price",
    ];

    public function product()
    {
        return $this->belongsTo(AccountingProduct::class, "product_id");
    }

    public function request()
    {
        return $this->belongsTo(AccountingSroreRequest::class, "request_id");
    }
}

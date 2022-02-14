<?php

namespace App\Models\AccountingSystem;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingPurchaseReturn
 *
 * @property int $id
 * @property int|null $purchase_id
 * @property string|null $total
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $amount
 * @property string|null $discount
 * @property int|null $supplier_id
 * @property int|null $store_id
 * @property string|null $payment
 * @property string|null $payed
 * @property string|null $totalTaxs
 * @property string|null $bill_num
 * @property string|null $discount_type
 * @property string|null $bill_date
 * @property int|null $branch_id
 * @property int|null $safe_id
 * @property int|null $user_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingPurchaseReturnItem[] $items
 * @property-read int|null $items_count
 * @property-read \App\Models\AccountingSystem\AccountingPurchase|null $purchase
 * @property-read \App\Models\AccountingSystem\AccountingSupplier|null $supplier
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn whereBillDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn whereBillNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn wherePayed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn wherePayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn wherePurchaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn whereSafeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn whereTotalTaxs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn whereUserId($value)
 * @mixin \Eloquent
 */
class AccountingPurchaseReturn extends Model
{
    protected $fillable = [
        "total",
        "purchase_id",
        "amount",
        "discount",
        "supplier_id",
        "store_id",
        "payment",
        "payed",
        "totalTaxs",
        "bill_num",
        "discount_type",
        "bill_date",
        "branch_id",
        "safe_id",
        "user_id",
    ];

    protected $table = "accounting_purchases_returns";

    public function getPdfAttribute()
    {
        return route("api.suppliers.purchase-return.show", $this->id);
    }

    public function supplier()
    {
        return $this->belongsTo(AccountingSupplier::class, "supplier_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function purchase()
    {
        return $this->belongsTo(AccountingPurchase::class, "purchase_id");
    }

    public function items()
    {
        return $this->hasMany(
            AccountingPurchaseReturnItem::class,
            "purchase_return_id"
        );
    }
}

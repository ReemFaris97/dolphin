<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingPurchase
 *
 * @property int $id
 * @property string|null $amount
 * @property int|null $discount
 * @property string|null $total
 * @property int|null $supplier_id
 * @property int|null $store_id
 * @property string|null $payment
 * @property string|null $payed
 * @property string|null $debts
 * @property string|null $totalTaxs
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $bill_num
 * @property int|null $purchase_id
 * @property int|null $safe_id
 * @property int|null $company_id
 * @property int|null $branch_id
 * @property string|null $discount_type
 * @property string|null $bill_date
 * @property int|null $daily_number
 * @property int|null $counter
 * @property string|null $counter_purchase
 * @property int|null $user_id
 * @property int|null $account_id
 * @property-read \App\Models\AccountingSystem\AccountingBranch|null $branch
 * @property-read \App\Models\AccountingSystem\AccountingCompany|null $company
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingPurchaseItem[] $items
 * @property-read int|null $items_count
 * @property-read \App\Models\AccountingSystem\AccountingSafe|null $safe
 * @property-read \App\Models\AccountingSystem\AccountingSession $session
 * @property-read \App\Models\AccountingSystem\AccountingStore|null $store
 * @property-read \App\Models\AccountingSystem\AccountingSupplier|null $supplier
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereBillDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereBillNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereCounter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereCounterPurchase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereDailyNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereDebts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase wherePayed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase wherePayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase wherePurchaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereSafeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereTotalTaxs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereUserId($value)
 * @mixin \Eloquent
 */
class AccountingPurchase extends Model
{
    protected $fillable = [
        "supplier_id",
        "total",
        "amount",
        "discount",
        "payment",
        "payed",
        "debts",
        "package_id",
        "store_id",
        "bill_num",
        "totalTaxs",
        "safe_id",
        "user_id",
        "company_id",
        "branch_id",
        "discount_type",
        "bill_date",
        "counter",
        "daily_number",
        "counter_purchase",
        "account_id",
    ];
    protected $table = "accounting_purchases";

    public function getPdfAttribute()
    {
        return route("api.suppliers.purchase.show", $this->id);
    }

    public function supplier()
    {
        return $this->belongsTo(AccountingSupplier::class, "supplier_id");
    }
    public function session()
    {
        return $this->belongsTo(AccountingSession::class, "session_id");
    }
    public function safe()
    {
        return $this->belongsTo(AccountingSafe::class, "safe_id");
    }
    public function company()
    {
        return $this->belongsTo(AccountingCompany::class, "company_id");
    }
    public function branch()
    {
        return $this->belongsTo(AccountingBranch::class, "branch_id");
    }

    public function store()
    {
        return $this->belongsTo(AccountingStore::class, "store_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function items()
    {
        return $this->hasMany(AccountingPurchaseItem::class, "purchase_id");
    }

    public function getTotalDiscountAttribute()
    {
        return $this->items?->sum("total_item_discount");
    }
}

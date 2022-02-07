<?php

namespace App\Models\AccountingSystem;

use App\Events\Accounting\SaleAdded;
use App\helper\num_to_ar;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\Models\AccountingSystem\AccountingSale
 *
 * @property int $id
 * @property string|null $amount
 * @property int|null $discount
 * @property string|null $total
 * @property int|null $client_id
 * @property string|null $payment
 * @property string|null $payed
 * @property string|null $debts
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $package_id
 * @property int|null $session_id
 * @property int|null $branch_id
 * @property int|null $company_id
 * @property int|null $store_id
 * @property string|null $bill_num
 * @property string|null $status
 * @property string|null $totalTaxs
 * @property int|null $user_id
 * @property string|null $cash
 * @property string|null $network
 * @property string|null $discount_type
 * @property int|null $daily_number
 * @property int|null $counter
 * @property string|null $counter_sale
 * @property string|null $date
 * @property int|null $account_id
 * @property-read \App\Models\AccountingSystem\AccountingBranch|null $branch
 * @property-read \App\Models\AccountingSystem\AccountingClient|null $client
 * @property-read \App\Models\AccountingSystem\AccountingCompany|null $company
 * @property-read mixed $item_cost
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingSaleItem[] $items
 * @property-read int|null $items_count
 * @property-read \App\Models\AccountingSystem\AccountingSession|null $session
 * @property-read \App\Models\AccountingSystem\AccountingStore|null $store
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereBillNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereCash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereCounter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereCounterSale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereDailyNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereDebts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereNetwork($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale wherePackageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale wherePayed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale wherePayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereTotalTaxs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereUserId($value)
 * @mixin \Eloquent
 */
class AccountingSale extends Model
{
    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    protected $fillable = [
        "client_id",
        "total",
        "amount",
        "discount",
        "payment",
        "payed",
        "debts",
        "package_id",
        "session_id",
        "branch_id",
        "company_id",
        "store_id",
        "bill_num",
        "totalTaxs",
        "status",
        "user_id",
        "cash",
        "network",
        "discount_type",
        "counter",
        "daily_number",
        "counter_sale",
        "date",
        "account_id",
    ];
    protected $table = "accounting_sales";
    protected $appends = ["item_cost"];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        "created" => SaleAdded::class,
    ];
    public function client()
    {
        return $this->belongsTo(AccountingClient::class, "client_id");
    }
    public function session()
    {
        return $this->belongsTo(AccountingSession::class, "session_id");
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
    public function fund_transactions()
    {
        return $this->morphMany(AccountingFundTransaction::class, "billable");
    }

    public function getFundAttribute()
    {
        return $this->session?->device?->fund;
    }

    public function getNetworkFundAttribute()
    {
        return $this->session?->device?->branch
            ->funds()
            ->where("type", 1)
            ?->first();
    }

    public function addCashToFund()
    {
        if ($this->cash > 0 && $this->fund != null) {
            $this->fund_transactions()->create([
                "fund_id" => $this->fund->id,
                "type" => "in",
                "amount" => $this->cash,
                "description" => "added from sales",
            ]);
        }
    }

    public function addNetworkToFund()
    {
        if ($this->network > 0 && $this->network_fund != null) {
            $this->fund_transactions()->create([
                "fund_id" => $this->fund->id,
                "type" => "in",
                "amount" => $this->network,
                "description" => "added from sales",
            ]);
        }
    }
    public function CashArabic($cach)
    {
        $total = explode(".", $cach);
        $total_in_arabic_rial = new num_to_ar($total[0], "male");
        $total_in_arabic_halla = new num_to_ar($total[1] ?? 0, "male");
        $AllTotal = [
            $total_in_arabic_rial->convert_number(),
            $total_in_arabic_halla->convert_number() ?? 0,
        ];
        return $AllTotal;
    }
    public function product_total()
    {
        $total = 0;

        foreach ($this->items as $item) {
            $sum = $item->price * $item->quantity;
            $total += $sum;
        }
        return round($total, 2);
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function items()
    {
        return $this->hasMany(AccountingSaleItem::class, "sale_id");
    }

    public function getItemCostAttribute()
    {
        $products_item = AccountingSaleItem::where("sale_id", $this->id)
            ->pluck("product_id", "quantity")
            ->toArray();

        $cost = 0;
        foreach ($products_item as $key => $product_id) {
            $product = AccountingProduct::find($product_id);
            try {
                $cost +=
                    (floatval($product->purchasing_price) ?? 0) *
                    floatval($key);
            } catch (\Exception $exception) {
                // اانا اسف والله
            }
        }

        return $cost;
    }

    public function scopeOfUser($query, $user_id)
    {
        return $query->where("user_id", $user_id);
    }

    public function scopeInPeriod($query, $start, $end)
    {
        return $query->whereBetween("created_at", [$start, $end]);
    }

    /**
     * fix bug of paid cash is more than total amount of sale for old invoices
     *
     * @return float|string
     */
    public function getCashAttribute()
    {
        return $this->attributes["cash"] > $this->attributes["amount"]
            ? $this->attributes["amount"]
            : $this->attributes["cash"];
    }
}

<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingMoneyClause
 *
 * @property int $id
 * @property string|null $sanad_num
 * @property string $default
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $concerned
 * @property int|null $client_id
 * @property int|null $supplier_id
 * @property int|null $benod_id
 * @property int|null $safe_id
 * @property string|null $amount
 * @property string|null $notes
 * @property \App\Models\AccountingSystem\AccountingPayment|null $payment
 * @property int|null $company_id
 * @property int|null $branch_id
 * @property int|null $user_id
 * @property string|null $num
 * @property int|null $bank_id
 * @property string|null $num_transaction
 * @property string|null $image
 * @property string|null $name
 * @property string|null $date
 * @property string|null $description
 * @property int|null $center_id
 * @property int|null $account_id
 * @property int|null $payment_id
 * @property int|null $revenue_account_id
 * @property-read \App\Models\AccountingSystem\AccountingBank|null $bank
 * @property-read \App\Models\AccountingSystem\AccountingBenod|null $benod
 * @property-read \App\Models\AccountingSystem\AccountingBranch|null $branch
 * @property-read \App\Models\AccountingSystem\AccountingCostCenter|null $center
 * @property-read \App\Models\AccountingSystem\AccountingClient|null $client
 * @property-read \App\Models\AccountingSystem\AccountingCompany|null $company
 * @property-read \App\Models\AccountingSystem\AccountingSafe|null $safe
 * @property-read \App\Models\AccountingSystem\AccountingSupplier|null $supplier
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereBenodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereCenterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereConcerned($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereNumTransaction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause wherePayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereRevenueAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereSafeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereSanadNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereUserId($value)
 * @mixin \Eloquent
 */
class AccountingMoneyClause extends Model
{
    protected $fillable = [
        "benod_id",
        "type",
        "default",
        "sanad_num",
        "user_id",
        "num",
        "description",
        "date",
        "safe_id",
        "amount",
        "notes",
        "revenue_account_id",
        "bank_id",
        "num_transaction",
        "image",
        "name",
        "center_id",
        "account_id",
        "payment_id",
    ];

    public function safe()
    {
        return $this->belongsTo(AccountingSafe::class, "safe_id");
    }

    public function client()
    {
        return $this->belongsTo(AccountingClient::class, "client_id");
    }

    public function bank()
    {
        return $this->belongsTo(AccountingBank::class, "bank_id");
    }

    public function payment()
    {
        return $this->belongsTo(AccountingPayment::class, "payment_id");
    }
    public function supplier()
    {
        return $this->belongsTo(AccountingSupplier::class, "supplier_id");
    }

    public function company()
    {
        return $this->belongsTo(AccountingCompany::class, "company_id");
    }

    public function center()
    {
        return $this->belongsTo(AccountingCostCenter::class, "center_id");
    }
    public function branch()
    {
        return $this->belongsTo(AccountingBranch::class, "branch_id");
    }

    public function benod()
    {
        return $this->belongsTo(AccountingBenod::class, "benod_id");
    }
}

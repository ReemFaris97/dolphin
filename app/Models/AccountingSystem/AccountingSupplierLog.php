<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingSupplierLog
 *
 * @property int $id
 * @property int|null $supplier_id
 * @property int|null $purchase_id
 * @property int|null $clause_id
 * @property string|null $status
 * @property string|null $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $new_balance
 * @property string|null $type
 * @property int|null $return_id
 * @property-read \App\Models\AccountingSystem\AccountingMoneyClause|null $clause
 * @property-read \App\Models\AccountingSystem\AccountingPurchase|null $purchase
 * @property-read \App\Models\AccountingSystem\AccountingSupplier|null $supplier
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierLog whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierLog whereClauseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierLog whereNewBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierLog wherePurchaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierLog whereReturnId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierLog whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierLog whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierLog whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingSupplierLog extends Model
{
    protected $fillable = [
        "supplier_id",
        "purchase_id",
        "clause_id",
        "status",
        "amount",
        "type",
        "new_balance",
        "return_id",
    ];
    protected $table = "accounting_supplier_log";

    public function purchase()
    {
        return $this->belongsTo(AccountingPurchase::class, "purchase_id");
    }

    public function supplier()
    {
        return $this->belongsTo(AccountingSupplier::class, "supplier_id");
    }
    public function clause()
    {
        return $this->belongsTo(AccountingMoneyClause::class, "clause_id");
    }
}

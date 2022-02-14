<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingSupplierCompany
 *
 * @property int $id
 * @property int|null $supplier_id
 * @property int|null $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AccountingSystem\AccountingCompany|null $company
 * @property-read \App\Models\AccountingSystem\AccountingSupplier|null $supplier
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierCompany newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierCompany newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierCompany query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierCompany whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierCompany whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierCompany whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierCompany whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierCompany whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingSupplierCompany extends Model
{
    protected $fillable = ["supplier_id", "company_id"];
    protected $table = "accounting_suppliers_companies";

    public function company()
    {
        return $this->belongsTo(AccountingCompany::class, "company_id");
    }

    public function supplier()
    {
        return $this->belongsTo(AccountingSupplier::class, "supplier_id");
    }
}

<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingClient
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $fax
 * @property int|null $category
 * @property string|null $tax_number
 * @property string|null $commercial_registration_no
 * @property string|null $type_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $type_bills
 * @property int $credit
 * @property string|null $amount
 * @property string|null $period
 * @property int $taxes_status
 * @property string|null $currency
 * @property int $is_active
 * @property string|null $balance
 * @property int|null $account_id
 * @property-read \App\Models\AccountingSystem\AccountingAccount|null $account
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereCommercialRegistrationNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereCredit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereFax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient wherePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereTaxNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereTaxesStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereTypeBills($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereTypePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingClient extends Model
{
    protected $fillable = [
        "name",
        "email",
        "phone",
        "fax",
        "category",
        "tax_number",
        "commercial_registration_no",
        "type_price",
        "type_bills",
        "credit",
        "amount",
        "period",
        "currency",
        "taxes_status",
        "is_active",
        "balance",
        "date",
        "account_id",
    ];
    protected $table = "accounting_clients";

    public function account()
    {
        return $this->belongsTo(AccountingAccount::class, "account_id");
    }
}

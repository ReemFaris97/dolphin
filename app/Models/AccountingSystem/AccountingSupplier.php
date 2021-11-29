<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingSupplier
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $email
 * @property int|null $branch_id
 * @property int $credit
 * @property string|null $amount
 * @property string|null $period
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property mixed|null $phones
 * @property string|null $password
 * @property string|null $image
 * @property int|null $bank_id
 * @property string|null $bank_account_number
 * @property string|null $tax_number
 * @property int $is_active
 * @property string|null $balance
 * @property int|null $account_id
 * @property-read \App\Models\AccountingSystem\AccountingAccount|null $account
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingSupplierCompany[] $companies
 * @property-read int|null $companies_count
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier whereBankAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier whereBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier whereCredit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier wherePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier wherePhones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier whereTaxNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingSupplier extends Model
{
    protected $table='accounting_suppliers';
    
    protected $fillable = ['name','email','phone','credit','branch_id','amount','password','image','bank_id',
        'bank_account_number','tax_number','is_active','balance','account_id','phones'
    ];


    public function companies()
    {
        return $this->hasMany(AccountingSupplierCompany::class, 'supplier_id');
    }


    public function balances()
    {
        $balance=AccountingPurchase::where('supplier_id', $this->id)->where('payment', 'agel')->sum('total');

        return $balance;
    }
    public function account()
    {
        return $this->belongsTo(AccountingAccount::class, 'account_id');
    }
}

<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Events\Accounting\FundSaved;

/**
 * App\Models\AccountingFund
 *
 * @property int $id
 * @property string $name
 * @property string $name_en
 * @property int|null $company_id
 * @property int|null $branch_id
 * @property int|null $is_bank
 * @property int|null $bank_id
 * @property string|null $bank_account_number
 * @property string|null $description
 * @property string|null $created_by_type
 * @property int|null $created_by_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFund newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFund newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFund query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFund whereBankAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFund whereBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFund whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFund whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFund whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFund whereCreatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFund whereCreatedByType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFund whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFund whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFund whereIsBank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFund whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFund whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFund whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingFund extends Model
{
    use HasFactory;
 
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'saved' => FundSaved::class,
        // 'deleted' => UserDeleted::class,
    ];

    public function branch():BelongsTo
    {
        return $this->belongsTo(AccountingBranch::class, 'branch_id');
    }

    public function company():BelongsTo
    {
        return $this->belongsTo(AccountingCompany::class, 'company_id');
    }

    public function created_by():BelongsTo
    {
        return $this->morphTo('created_by');
    }
    public function transaction()
    {
        return $this->morphOne(AccountingFundTransaction::class, 'billable');
    }
}

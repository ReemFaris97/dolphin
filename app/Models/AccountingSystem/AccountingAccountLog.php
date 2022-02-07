<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingAccountLog
 *
 * @property int $id
 * @property int|null $entry_id
 * @property int|null $account_id
 * @property string|null $account_amount_before
 * @property int|null $another_account_id
 * @property string|null $affect
 * @property string|null $amount
 * @property string|null $account_amount_after
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $status
 * @property-read \App\Models\AccountingSystem\AccountingAccount|null $account
 * @property-read \App\Models\AccountingSystem\AccountingAccount|null $another_account
 * @property-read \App\Models\AccountingSystem\AccountingEntry|null $entry
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountLog whereAccountAmountAfter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountLog whereAccountAmountBefore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountLog whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountLog whereAffect($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountLog whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountLog whereAnotherAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountLog whereEntryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountLog whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingAccountLog extends Model
{
    protected $fillable = [
        "entry_id",
        "account_id",
        "account_amount_before",
        "another_account_id",
        "affect",
        "amount",
        "account_amount_after",
        "status",
    ];
    protected $table = "accounting_accounts_logs";

    public function entry()
    {
        return $this->belongsTo(AccountingEntry::class, "entry_id");
    }
    public function account()
    {
        return $this->belongsTo(AccountingAccount::class, "account_id");
    }
    public function another_account()
    {
        return $this->belongsTo(AccountingAccount::class, "another_account_id");
    }
}

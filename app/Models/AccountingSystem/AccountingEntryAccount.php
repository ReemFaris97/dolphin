<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingEntryAccount
 *
 * @property int $id
 * @property int|null $entry_id
 * @property int|null $account_id
 * @property string|null $affect
 * @property string|null $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $from_account_id
 * @property int|null $to_account_id
 * @property-read \App\Models\AccountingSystem\AccountingAccount|null $account
 * @property-read \App\Models\AccountingSystem\AccountingEntry|null $entry
 * @property-read \App\Models\AccountingSystem\AccountingAccount|null $from
 * @property-read \App\Models\AccountingSystem\AccountingAccount|null $to
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryAccount whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryAccount whereAffect($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryAccount whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryAccount whereEntryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryAccount whereFromAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryAccount whereToAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryAccount whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingEntryAccount extends Model
{
    protected $fillable = ['amount','from_account_id','to_account_id','entry_id','affect','account_id'];
    protected $table='accounting_entries_accounts';

    public function entry()
    {
        return $this->belongsTo(AccountingEntry::class, 'entry_id');
    }


    public function account()
    {
        return $this->belongsTo(AccountingAccount::class, 'account_id');
    }
    public function from()
    {
        return $this->belongsTo(AccountingAccount::class, 'from_account_id');
    }


    public function to()
    {
        return $this->belongsTo(AccountingAccount::class, 'to_account_id');
    }
}

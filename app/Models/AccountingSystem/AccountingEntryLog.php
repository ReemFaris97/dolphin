<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingEntryLog
 *
 * @property int $id
 * @property int|null $entry_id
 * @property string|null $operation
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $account_id
 * @property string|null $debtor
 * @property string|null $creditor
 * @property-read \App\Models\AccountingSystem\AccountingAccount|null $account
 * @property-read \App\Models\AccountingSystem\AccountingEntry|null $entry
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryLog whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryLog whereCreditor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryLog whereDebtor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryLog whereEntryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryLog whereOperation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryLog whereUserId($value)
 * @mixin \Eloquent
 */
class AccountingEntryLog extends Model
{
    protected $fillable = ['entry_id','operation','user_id','account_id','debtor','creditor'];
    protected $table='accounting_entries_log';

    public function entry()
    {
        return $this->belongsTo(AccountingEntry::class,'entry_id');
    }
    public function account()
    {
        return $this->belongsTo(AccountingAccount::class,'account_id');
    }

}

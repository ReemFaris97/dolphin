<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingEntry
 *
 * @property int $id
 * @property string|null $date
 * @property string|null $source
 * @property string|null $type
 * @property string|null $code
 * @property string|null $currency
 * @property string|null $details
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $status
 * @property int|null $branch_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingEntryAccount[] $accounts
 * @property-read int|null $accounts_count
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntry query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntry whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntry whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntry whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntry whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntry whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntry whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntry whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntry whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntry whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingEntry extends Model
{
    protected $fillable = ['date','source','type','code','currency','amount','details','status'];
    protected $table='accounting_entries';

    public function accounts()
    {
        return $this->hasMany(AccountingEntryAccount::class, 'entry_id')->orderBy('affect', 'asc');
    }
    public function accounts_debtor()
    {
        $accounts_debtor=AccountingEntryAccount::where('entry_id', $this->id)->where('affect', 'debtor')->get();
        return $accounts_debtor;
    }

    public function accounts_creditor()
    {
        $accounts_creditor=AccountingEntryAccount::where('entry_id', $this)->where('affect', 'creditor')->get();
        return $accounts_creditor;
    }
}

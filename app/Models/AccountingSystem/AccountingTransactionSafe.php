<?php

namespace App\Models\AccountingSystem;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingTransactionSafe
 *
 * @property int $id
 * @property int|null $safe_form_id
 * @property int|null $safe_to_id
 * @property string|null $amount
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $user_id
 * @property string|null $type
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransactionSafe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransactionSafe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransactionSafe query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransactionSafe whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransactionSafe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransactionSafe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransactionSafe whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransactionSafe whereSafeFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransactionSafe whereSafeToId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransactionSafe whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransactionSafe whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransactionSafe whereUserId($value)
 * @mixin \Eloquent
 */
class AccountingTransactionSafe extends Model
{
    protected $fillable = [
        "safe_form_id",
        "safe_to_id",
        "notes",
        "amount",
        "user_id",
        "type",
    ];
    protected $table = "accounting_safes_transactions";

    public function getSafeFrom()
    {
        return $this->belongsTo(AccountingSafe::class, "safe_form_id");
    }
    public function getSafeTo()
    {
        return $this->belongsTo(AccountingSafe::class, "safe_to_id");
    }
    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}

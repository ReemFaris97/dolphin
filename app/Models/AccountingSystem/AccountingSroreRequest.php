<?php

namespace App\Models\AccountingSystem;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingSroreRequest
 *
 * @property int $id
 * @property string $status
 * @property string|null $refused_reason
 * @property int|null $user_id
 * @property int|null $store_form
 * @property int|null $store_to
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $bond_id
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSroreRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSroreRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSroreRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSroreRequest whereBondId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSroreRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSroreRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSroreRequest whereRefusedReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSroreRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSroreRequest whereStoreForm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSroreRequest whereStoreTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSroreRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSroreRequest whereUserId($value)
 * @mixin \Eloquent
 */
class AccountingSroreRequest extends Model
{
    protected $fillable = [
        "user_id",
        "status",
        "refused_reason",
        "store_form",
        "store_to",
        "bond_id",
    ];

    protected $table = "accounting_stores_requests";

    public function getStoreFrom()
    {
        return $this->belongsTo(AccountingStore::class, "store_form");
    }
    public function getStoreTo()
    {
        return $this->belongsTo(AccountingStore::class, "store_to");
    }
    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}

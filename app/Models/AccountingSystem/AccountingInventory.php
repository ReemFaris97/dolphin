<?php

namespace App\Models\AccountingSystem;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingInventory
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $store_id
 * @property string $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $bond_num
 * @property string|null $description
 * @property int|null $cost_type
 * @property-read \App\Models\AccountingSystem\AccountingStore|null $store
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventory query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventory whereBondNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventory whereCostType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventory whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventory whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventory whereUserId($value)
 * @mixin \Eloquent
 */
class AccountingInventory extends Model
{
    protected $fillable = [
        "date",
        "user_id",
        "store_id",
        "bond_num",
        "description",
        "cost_type",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
    public function store()
    {
        return $this->belongsTo(AccountingStore::class, "store_id");
    }
}

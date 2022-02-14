<?php

namespace App\Models\AccountingSystem;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingDamage
 *
 * @property int $id
 * @property int|null $store_id
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingDamageProduct[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\AccountingSystem\AccountingStore|null $store
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamage query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamage whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamage whereUserId($value)
 * @mixin \Eloquent
 */
class AccountingDamage extends Model
{
    protected $fillable = ["user_id", "store_id"];

    protected $table = "accounting_damages";

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
    public function store()
    {
        return $this->belongsTo(AccountingStore::class, "store_id");
    }
    public function productCount()
    {
        return $this->hasMany(AccountingDamageProduct::class, "damage_id")->sum(
            "quantity"
        );
    }
    public function products()
    {
        return $this->hasMany(AccountingDamageProduct::class, "damage_id");
    }
}

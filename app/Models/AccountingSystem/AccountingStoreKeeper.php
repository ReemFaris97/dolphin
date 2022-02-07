<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingStoreKeeper
 *
 * @property int $id
 * @property string $phone
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property int|null $store_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AccountingSystem\AccountingStore|null $store
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStoreKeeper newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStoreKeeper newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStoreKeeper query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStoreKeeper whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStoreKeeper whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStoreKeeper whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStoreKeeper whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStoreKeeper whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStoreKeeper wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStoreKeeper whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStoreKeeper whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingStoreKeeper extends Model
{
    protected $table = "accounting_storekeepers";

    protected $fillable = ["name", "email", "password", "phone", "store_id"];

    public function store()
    {
        return $this->belongsTo(AccountingStore::class, "store_id");
    }
}

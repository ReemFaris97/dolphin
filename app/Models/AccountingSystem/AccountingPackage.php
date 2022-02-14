<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingPackage
 *
 * @property int $id
 * @property int|null $client_id
 * @property string|null $total
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $status
 * @property-read \App\Models\AccountingSystem\AccountingClient|null $client
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingOffer[] $offers
 * @property-read int|null $offers_count
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPackage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPackage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPackage query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPackage whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPackage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPackage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPackage whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPackage whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPackage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingPackage extends Model
{
    protected $fillable = ["client_id", "total"];
    protected $table = "accounting_packages";

    public function offers()
    {
        return $this->hasMany(AccountingOffer::class, "package_id");
    }

    public function client()
    {
        return $this->belongsTo(AccountingClient::class, "client_id");
    }
}

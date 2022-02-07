<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingNotifiaction
 *
 * @property int $id
 * @property int|null $client_id
 * @property int|null $package_id
 * @property string|null $read_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingNotifiaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingNotifiaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingNotifiaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingNotifiaction whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingNotifiaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingNotifiaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingNotifiaction wherePackageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingNotifiaction whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingNotifiaction whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingNotifiaction extends Model
{
    protected $fillable = ["client_id", "package_id", "read_at"];
    protected $table = "accounting_notifactions";
}

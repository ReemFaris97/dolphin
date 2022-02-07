<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SupplierLog
 *
 * @property int $id
 * @property int $user_id
 * @property string $log
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierLog whereLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierLog whereUserId($value)
 * @mixin \Eloquent
 */
class SupplierLog extends Model
{
    protected $fillable = ["user_id", "log"];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}

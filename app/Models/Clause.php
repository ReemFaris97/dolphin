<?php

namespace App\Models;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Clause
 *
 * @property int $id
 * @property string $name
 * @property int|null $amount
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $user_id
 * @property int|null $default_amount
 * @property string|null $blocked_at
 * @property-read mixed $is_active
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ClauseLog[] $logs
 * @property-read int|null $logs_count
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Clause newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Clause newQuery()
 * @method static \Illuminate\Database\Query\Builder|Clause onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Clause query()
 * @method static \Illuminate\Database\Eloquent\Builder|Clause whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clause whereBlockedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clause whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clause whereDefaultAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clause whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clause whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clause whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clause whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clause whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Clause withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Clause withoutTrashed()
 * @mixin \Eloquent
 */
class Clause extends Model
{
    use SoftDeletes;
    protected $fillable = [
        "name",
        "amount",
        "user_id",
        "default_amount",
        "blocked_at",
    ];

    protected $appends = ["is_active"];
    public function logs()
    {
        return $this->hasMany(ClauseLog::class);
    }

    public function getIsActiveAttribute()
    {
        $log = $this->logs()
            ->whereDate("created_at", Carbon::today())
            ->count();

        return !!!$log;
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}

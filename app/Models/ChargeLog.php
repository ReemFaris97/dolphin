<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ChargeLog
 *
 * @property int $id
 * @property int $worker_id
 * @property string|null $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $charge_id
 * @property int|null $previous_worker_id
 * @property-read \App\Models\Charge $charge
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @property-read User|null $previousWorker
 * @property-read User $worker
 * @method static \Illuminate\Database\Eloquent\Builder|ChargeLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChargeLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChargeLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChargeLog whereChargeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChargeLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChargeLog whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChargeLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChargeLog wherePreviousWorkerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChargeLog whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChargeLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChargeLog whereWorkerId($value)
 * @mixin \Eloquent
 */
class ChargeLog extends Model
{
    protected $fillable = [
        "worker_id",
        "type",
        "charge_id",
        "previous_worker_id",
    ];

    public function images()
    {
        return $this->morphMany(Image::class, "model");
    }

    public function charge()
    {
        return $this->belongsTo(Charge::class, "charge_id");
    }

    public function worker()
    {
        return $this->belongsTo(User::class, "worker_id");
    }

    public function previousWorker()
    {
        return $this->belongsTo(User::class, "previous_worker_id");
    }
}

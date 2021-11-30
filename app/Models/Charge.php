<?php

namespace App\Models;

use App\Events\ChargeReceived;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Charge
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $worker_id
 * @property int $supervisor_id
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $destroyed_at
 * @property string|null $code
 * @property string|null $confirmed_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ChargeLog[] $logs
 * @property-read int|null $logs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Note[] $notes
 * @property-read int|null $notes_count
 * @property-read \App\Models\User $supervisor
 * @property-read \App\Models\User $worker
 * @method static \Illuminate\Database\Eloquent\Builder|Charge newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Charge newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Charge query()
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereDestroyedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereSupervisorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereWorkerId($value)
 * @mixin \Eloquent
 */
class Charge extends Model
{
    protected $fillable = ['name', 'description', 'worker_id', 'supervisor_id', 'destroyed_at', 'code', 'confirmed_at'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($charge) {
            $charge['code'] = 1234;
        });
    }

    public function worker()
    {
        return $this->belongsTo(User::class, 'worker_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'model');
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'model');
    }

    public function logs()
    {
        return $this->hasMany(ChargeLog::class, 'charge_id');
    }


    /**
     * Mark the Charge as Destroyed.
     *
     * @return void
     */
    public function markAsDestroyed()
    {
        if (is_null($this->destroyed_at)) {
            $this->forceFill(['destroyed_at' => $this->freshTimestamp()])->save();
        }
    }

    /**
     * Mark the Charge as Confirmed.
     *
     * @return void
     */
    public function markAsConfirmed()
    {
        if (is_null($this->confirmed_at)) {
            $this->forceFill(['confirmed_at' => $this->freshTimestamp()])->save();
            if ($this->worker != null) {
            event(new ChargeReceived($this->worker, $this));
        }
        }
    }

    /**
     * Mark the Charge as Destroyed.
     *
     * @return void
     */
    public function markAsUnDestroyed()
    {
        if (!is_null($this->destroyed_at)) {
            $this->forceFill(['destroyed_at' => null])->save();
        }
    }
}

<?php

namespace App\Models;

use App\Events\ChargeReceived;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

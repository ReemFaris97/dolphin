<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class DistributorRoute extends Model
{
    protected $fillable = ['name', 'is_finished', 'is_active', 'user_id', 'arrange', 'round'];
protected static function boot()
{
        parent::boot();

    static::addGlobalScope('arrange', function (Builder $builder) {
            $builder->orderBy('round', 'asc');
        $builder->orderBy('arrange', 'asc');
    });

}

    public function trips()
    {
        return $this->hasMany(RouteTrips::class, 'route_id')->orderBy('arrange', 'asc');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id')->withDefault();
    }

    public function points()
    {
        return $routeTrips = $this->trips();

    }


    /**
     * inventory
     *
     * @return HasManyThrough
     */
    public function inventory(): HasManyThrough
    {
        return $this->hasManyThrough(TripInventory::class, RouteTrips::class, 'route_id', 'trip_id');
    }

    /**
     * trips_reports
     *
     * @return HasManyThrough
     */
    public function trips_reports(): HasManyThrough
    {
        return $this->hasManyThrough(RouteTripReport::class, RouteTrips::class, 'route_id', 'route_trip_id');
    }


}






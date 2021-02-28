<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class DistributorRoute extends Model
{
    protected $fillable = ['name', 'is_finished', 'is_active', 'user_id', 'arrange', 'round','received_code','is_available'];


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
    public function clients()
    {
        return $this->hasMany(RouteTrips::class, 'route_id')->groupBy('client_id')->get()->count();
    }
    public function accepted_trips()
    {
        return $this->hasMany(RouteTrips::class, 'route_id')->where('status','accepted')->get()->count();
    }
    public function refused_trips()
    {
        return $this->hasMany(RouteTrips::class, 'route_id')->where('status','refused')->get()->count();
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
        return $this->hasManyThrough(
            RouteTripReport::class,
             RouteTrips::class,
              'route_id',
             'route_trip_id');
    }

    public function expenses(){

        return $this->hasMany(Expense::class, 'distributor_route_id');
    }

    public function round_expenses(){

        return $this->expenses()->whereColumn('expenses.round', 'round');
    }

    /**
     * trips_reports
     *
     * @return HasManyThrough
     */
    public function round_trips_reports(): HasManyThrough
    {
        return $this->hasManyThrough(
            RouteTripReport::class,
            RouteTrips::class,
            'route_id',
            'route_trip_id'
        )->whereColumn('route_trips.round', 'route_trip_reports.round');
    }


}






<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * App\Models\DistributorRoute
 *
 * @property int $id
 * @property string $name
 * @property int $user_id
 * @property int $is_finished
 * @property int $is_active
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $arrange
 * @property int $round
 * @property string|null $received_code
 * @property int $is_available
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Expense[] $expenses
 * @property-read int|null $expenses_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TripInventory[] $inventory
 * @property-read int|null $inventory_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RouteTripReport[] $round_trips_reports
 * @property-read int|null $round_trips_reports_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RouteTrips[] $trips
 * @property-read int|null $trips_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RouteTripReport[] $trips_reports
 * @property-read int|null $trips_reports_count
 * @property-read User $user
 * @method static Builder|DistributorRoute newModelQuery()
 * @method static Builder|DistributorRoute newQuery()
 * @method static Builder|DistributorRoute query()
 * @method static Builder|DistributorRoute whereArrange($value)
 * @method static Builder|DistributorRoute whereCreatedAt($value)
 * @method static Builder|DistributorRoute whereDeletedAt($value)
 * @method static Builder|DistributorRoute whereId($value)
 * @method static Builder|DistributorRoute whereIsActive($value)
 * @method static Builder|DistributorRoute whereIsAvailable($value)
 * @method static Builder|DistributorRoute whereIsFinished($value)
 * @method static Builder|DistributorRoute whereName($value)
 * @method static Builder|DistributorRoute whereReceivedCode($value)
 * @method static Builder|DistributorRoute whereRound($value)
 * @method static Builder|DistributorRoute whereUpdatedAt($value)
 * @method static Builder|DistributorRoute whereUserId($value)
 * @mixin \Eloquent
 */
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






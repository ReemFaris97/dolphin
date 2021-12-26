<?php

namespace App\Models;

use App\Models\User;
use App\Services\RouteTripCollection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RouteTrips
 *
 * @property int $id
 * @property int $route_id
 * @property int $client_id
 * @property string $lat
 * @property string $lng
 * @property string $address
 * @property int $arrange
 * @property string $status
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $cash
 * @property int $round
 * @property-read \App\Models\TripInventory|null $LastInventory
 * @property-read \App\Models\Client $client
 * @property-read void $is_last_report_has_images
 * @property-read mixed $total
 * @property-read mixed $total_inventories_in_round
 * @property-read mixed $total_reports_in_round
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @property-read \App\Models\TripInventory|null $inventory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AttachedProducts[] $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RouteTripReport[] $reports
 * @property-read int|null $reports_count
 * @property-read \App\Models\DistributorRoute $route
 * @property-read User $user
 * @method static Builder|RouteTrips newModelQuery()
 * @method static Builder|RouteTrips newQuery()
 * @method static Builder|RouteTrips ofDistributor($distributor)
 * @method static Builder|RouteTrips orderByDistance($lat, $lng)
 * @method static Builder|RouteTrips query()
 * @method static Builder|RouteTrips whereAddress($value)
 * @method static Builder|RouteTrips whereArrange($value)
 * @method static Builder|RouteTrips whereCash($value)
 * @method static Builder|RouteTrips whereClientId($value)
 * @method static Builder|RouteTrips whereCreatedAt($value)
 * @method static Builder|RouteTrips whereDeletedAt($value)
 * @method static Builder|RouteTrips whereId($value)
 * @method static Builder|RouteTrips whereLat($value)
 * @method static Builder|RouteTrips whereLng($value)
 * @method static Builder|RouteTrips whereRound($value)
 * @method static Builder|RouteTrips whereRouteId($value)
 * @method static Builder|RouteTrips whereStatus($value)
 * @method static Builder|RouteTrips whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RouteTrips extends Model
{
    protected $fillable = ['route_id', 'client_id', 'lat', 'lng', 'address', 'status', 'arrange', 'cash', 'round','is_active'];

    protected $appends = ['total'];


    public function route()
    {
        return $this->belongsTo(DistributorRoute::class, 'route_id')->withDefault();
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id')->withDefault();
    }

    public function reports()
    {
        return $this->hasMany(RouteTripReport::class, 'route_trip_id');
    }

    public function getCurrentReport()
    {
        return $this->hasOne(RouteTripReport::class, 'route_trip_id')
            ->latest()
            ->whereColumn('round', 'route_trip_reports.round');
    }

    public function getLatestReport()
    {
        return $this->hasOne(RouteTripReport::class, 'route_trip_id')->latest();
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'model');
    }

    public function products()
    {
        return $this->morphMany(AttachedProducts::class, 'model');
    }

    public function inventory()
    {
        return $this->hasOne(TripInventory::class, 'trip_id');
    }

    public function LastInventory()
    {
        return $this->hasOne(TripInventory::class, 'trip_id')
            ->whereColumn('round', 'trip_inventories.round')
            ->latest();
    }

    public function scopeOfDistributor(Builder $builder, $distributor): void
    {
        $builder->whereHas('route', function ($route) use ($distributor) {
            $route->where('user_id', $distributor);
        });
    }

    public function scopeOfDistributors(Builder $builder, array $distributors): void
    {
        $builder->whereHas('route', function ($route) use ($distributors) {
            $route->whereIn('user_id', $distributors);
        });
    }


    public function scopeOrderByDistance($q, $lat, $lng)
    {
        $circle_radius_kilometer = 6371;
        $circle_radius_mile = 3959;
        $haversine = " (" . $circle_radius_kilometer . " * acos(cos(radians(" . $lat . "))
                    * cos(radians(`lat`))
                    * cos(radians(`lng`)
                    - radians(" . $lng . "))
                    + sin(radians(" . $lat . "))
                    * sin(radians(`lat`))))";

        return $q->orderBy(\DB::raw($haversine), 'asc'); // 1 kilometer
    }

    public function getStatusAttribute()
    {
        if (optional($this->LastInventory)->round === $this->round) {
            return optional($this->LastInventory)->type;
        }

        return 'pending';
    }


    public function steps()
    {
        // $this->total_reports_in_round,
        // $this->total_inventories_in_round;

        if ($this->total_inventories_in_round === 0) {
            return 'inventory';
        }

        if ($this->total_reports_in_round < $this->total_inventories_in_round) {
            return 'bill';
        }

        if (
            $this->total_reports_in_round >= $this->total_inventories_in_round
            && !$this->is_last_report_has_images

        ) {
            return 'images';
        }
        if ($this->total_reports_in_round >= $this->total_inventories_in_round && $this->is_last_report_has_images) {
            return 'finished';
        }

        return 'unKnown';
    }

    public function getTotalReportsInRoundAttribute()
    {
        $route_round = $this->route->round;
        return $this->reports()->where('round', $route_round)->count();
    }

    public function getTotalInventoriesInRoundAttribute()
    {
        $route_round = $this->route->round;
        return $this->inventory()->where('type', 'accept')->where('round', $route_round)->count();
    }

    /**
     * count the images of the last report trip
     *
     * @return void
     */
    public function getIsLastReportHasImagesAttribute()
    {
        return optional($this->getLatestReport)->images->count() > 0;
    }


    public function getTotalAttribute()
    {
        $total = 0;
        foreach ($this->products as $product) {
            $total += $product->price * $product->quantity;
        }
        return $total;
    }
}

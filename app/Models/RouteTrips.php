<?php

namespace App\Models;

use App\Models\User;
use App\Services\RouteTripCollection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class RouteTrips extends Model
{
    protected $fillable = ['route_id', 'client_id', 'lat', 'lng', 'address', 'status', 'arrange', 'cash', 'round'];

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
        return $this->hasOne(RouteTripReport::class, 'route_trip_id')->where('round', $this->round);
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

    public function scopeOfDistributor(Builder $builder, $distributor): void
    {

        $builder->whereHas('route', function ($route) use ($distributor) {
            $route->where('user_id', $distributor);
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




    public function steps()
    {
        if (!$this->inventory) $status = "inventory";
        elseif (!$this->products->first()) $status = "bill";
        elseif (!$this->images->first()) $status = "images";
        else $status = "finished";
        return $status;
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

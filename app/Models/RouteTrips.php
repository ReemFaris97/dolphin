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
            &&!$this->is_last_report_has_images

            ) {
            return 'images';
        }
        if ($this->total_reports_in_round >= $this->total_inventories_in_round &&$this->is_last_report_has_images) {
            return 'finished';
        }

        return 'unkown';
        // if (!$this->inventory && $this->route->round===$this->round) {
        //     $status = "inventory";
        // } elseif (!$this->images->first() &&
        // !!optional(optional($this->getCurrentReport)->products)->first() && $this->inventory->type=='accept') {
        //     $status = "images";
        // } elseif (optional(optional($this->getCurrentReport)->products)->first()==null &&
        // $this->inventory->type=='accept'  && $this->images->first()==null) {
        //     $status = "bill";
        // } else {
        //     $status = "finished";
        // }
        // return $status??'unkown';
    }

    public function getTotalReportsInRoundAttribute()
    {
        $route_round= $this->route->round;
        return  $this->reports()->where('round', $route_round)->count();
    }

    public function getTotalInventoriesInRoundAttribute()
    {
        $route_round= $this->route->round;
        return  $this->inventory()->where('type', 'accept')->where('round', $route_round)->count();
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TripInventory extends Model
{
    protected $fillable = ['trip_id', 'type', 'notes', 'refuse_reason', 'route_trip_id'];

    public function trip()
    {
        return $this->belongsTo(RouteTrips::class,'trip_id')->withDefault();;
    }

    public function products()
    {
        return $this->morphMany(AttachedProducts::class,'model');
    }


    public function images()
    {
        return $this->morphMany(Image::class,'model');
    }

    public function trip_report(): HasOne
    {
        return $this->hasOne(RouteTripReport::class, 'route_trip_id', 'trip_id')->whereColumn('route_trip_reports.round', 'round');
    }


    public function scopeOfDistributor(Builder $builder, $distributor = null): void
    {
        $builder->whereHas('trip', function ($route_trip) use ($distributor) {
            $route_trip->OfDistributor($distributor);
        });
    }
    public function scopeFilterDistributor(Builder $builder, $distributor = null): void
    {
        $builder->when($distributor != null, function ($q) use ($distributor) {
            $q->ofDistributor($distributor);
        });
    }
    public function scopeFilterRoute(Builder $builder, $route = null): void
    {
        $builder->when($route != null, function ($q) use ($route) {
            $q->where('route_id', $route);
        });
    }
    public function scopeFilterWithDates(Builder $builder, $from_date = null, $to_date = null): void
    {
        $builder->when($from_date, function (Builder $q) use ($from_date) {
            $q->whereDate('created_at', '<=', $from_date);
        });

        $builder->when($to_date, function (Builder $q) use ($to_date) {
            $q->whereDate('created_at', '>=', $to_date);
        });
    }


}

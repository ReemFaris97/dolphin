<?php

namespace App\Models;

use DB;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TripInventory extends Model
{
    protected $fillable = ['trip_id', 'type', 'notes', 'round', 'refuse_reason', 'route_trip_id'];

    public function trip()
    {
        return $this->belongsTo(RouteTrips::class, 'trip_id')->withDefault();
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

    public function previous_trip_report(): BelongsTo
    {
        return $this->belongsTo(RouteTripReport::class, 'pervious_route_trip_report_id')->with('products');
    }
    public function previous_trip_inventory(): BelongsTo
    {
        return $this->belongsTo(TripInventory::class, 'pervious_inventory_id')
        ->with('products');
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
            $q->whereHas('trip', function ($trip) use ($route) {

                $trip->where('route_id', $route);
            });
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



    public function scopeWithReportProducts(Builder $builder): void
    {
        $builder->with(['trip_report' => function ($report) {
            $report->with('products');
        }]);
    }
    public function scopeWithTripClientAndRoute(Builder $builder): void
    {
        $builder->with(['trip' => function ($q) {
            $q->with('client', 'route');
        }]);
    }


    public function getTripTypeLabel()
    {

        if ($this->type == 'accept') {
            return   '<span style="color: green"> مقبول</span>';
        } elseif ($this->type == 'refuse') {
            return '<span style="color: red"> مرفوض</span>';
        }
        throw new Exception('un handle type ');
    }

    public function scopeWithPreviousTripInventory(Builder $builder): void
    {

        $builder->addSelect(DB::raw("
        (
            select id from trip_inventories as pervious
            where pervious.round < trip_inventories.round
            and pervious.trip_id = trip_inventories.trip_id
            order by 'desc' limit 1
        ) as pervious_inventory_id"));
    }

    public function scopeWithPreviousTripReport(Builder $builder): void
    {
        $builder->addSelect(DB::raw("
        (
            select id from route_trip_reports as pervious
            where pervious.round < trip_inventories.round
            and pervious.route_trip_id = trip_inventories.trip_id
            order by 'desc' limit 1
        ) as pervious_route_trip_report_id"));
    }
    public  function scopeWhereRouteId($q,$route_id):void
    {
        $q->whereHas('trip', function($trip) use($route_id){
            $trip->where('route_id',$route_id);
        });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RouteTripReport extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'route_trip_id',
        'round',
        'cash',
        'notes',
        'store_id',
        'distributor_transaction_id'
    ];
    /**
     * distributor_transaction relation
     *
     * @return BelongsTo
     */
    public function distributor_transaction(): BelongsTo
    {
        return $this->belongsTo(DistributorTransaction::class, 'distributor_transaction_id');
    }
    /**
     * route_trip relation
     *
     * @return BelongsTo
     */
    public function route_trip(): BelongsTo
    {
        return $this->belongsTo(RouteTrips::class, 'route_trip_id');
    }
    public function inventory(): HasOne
    {
        return $this->hasOne(TripInventory::class, 'trip_id', 'route_trip_id');
    }

    public function products()
    {
        return $this->morphMany(AttachedProducts::class, 'model')->with('product');
    }


    public function images()
    {
        return $this->morphMany(Image::class, 'model');
    }
    public function scopeOfDistributor(Builder $builder, $distributor = null): void
    {
        $builder->whereHas('route_trip', function ($route_trip) use ($distributor) {
            $route_trip->OfDistributor($distributor);
        });
    }
    public function scopeFilterDistributor(Builder $builder, $distributor = null): void
    {
        $builder->when($distributor != null, function ($q) use ($distributor) {
            $q->ofDistributor($distributor);
        });
    }


    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param mixed|null $year
     * @return void
     */
    public function scopeOfYear(Builder $builder, $year = null): void
    {
        $builder->when($year != null, function ($q) use ($year) {
            $q->whereYear('created_at', $year);
        });
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param mixed|null $month
     * @return void
     */
    public function scopeOfMonth(Builder $builder, $month = null): void
    {
        $builder->when($month != null, function ($q) use ($month) {
            $q->whereMonth('created_at', $month);
        });
    }


    public function getInvoiceNumberAttribute()
    {

        return  str_pad($this->id, 6, 0, STR_PAD_LEFT);
    }
}

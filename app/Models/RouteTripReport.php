<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function products()
    {
        return $this->morphMany(AttachedProducts::class, 'model');
    }


    public function images()
    {
        return $this->morphMany(Image::class, 'model');
    }


    public function getInvoiceNumberAttribute()
    {

        return  str_pad($this->id, 6, 0, STR_PAD_LEFT);
    }
}

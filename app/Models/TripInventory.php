<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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

    public function tripReport(): HasOne
    {
        return $this->hasOne(TripInventory::class, 'route_trip_id', 'trip_id');
    }


}

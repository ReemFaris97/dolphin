<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripInventory extends Model
{
    protected $fillable = ['trip_id', 'type', 'notes', 'refuse_reason'];

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

}

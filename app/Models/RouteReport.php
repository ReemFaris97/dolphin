<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class RouteReport extends Model
{

    protected $fillable = ['user_id','route_id','cash','expenses','image'];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }


    public function routetrip()
    {
        return $this->belongsTo(RouteTrips::class,'route_id');
    }

    public function products()
    {
        return $this->morphMany(AttachedProducts::class,'model');
    }

}

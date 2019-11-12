<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class DistributorRoute extends Model
{
    protected $fillable = ['name', 'is_finished', 'is_active','user_id'];

    public function trips()
    {
        return $this->hasMany(RouteTrips::class,'route_id')->orderBy('arrange','asc');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public  function points(){
        return  $routeTrips = $this->trips();

    }




}

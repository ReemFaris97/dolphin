<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class RouteReport extends Model
{

    protected $fillable = ['user_id', 'route_id', 'cash', 'expenses', 'image', 'round'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault(new User);
    }


    public function routetrip()
    {
        return $this->belongsTo(RouteTrips::class, 'route_id')->withDefault(new RouteTrips);
    }

    public function products()
    {
        return $this->morphMany(AttachedProducts::class,'model');
    }


    public function getInvoiceNumberAttribute()
    {
        return  str_pad($this->id, 6, 0, STR_PAD_LEFT);
    }

}

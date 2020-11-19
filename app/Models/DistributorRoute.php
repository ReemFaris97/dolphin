<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class DistributorRoute extends Model
{
    protected $fillable = ['name', 'is_finished', 'is_active', 'user_id', 'arrange'];
protected static function boot()
{
    parent::boot(); // TODO: Change the autogenerated stub

    static::addGlobalScope('arrange', function (Builder $builder) {
        $builder->orderBy('arrange', 'asc');
    });

}

    public function trips()
    {
        return $this->hasMany(RouteTrips::class, 'route_id')->orderBy('arrange', 'asc');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id')->withDefault();
    }

    public function points()
    {
        return $routeTrips = $this->trips();

    }

}






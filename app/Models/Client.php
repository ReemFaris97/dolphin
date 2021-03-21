<?php

namespace App\Models;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    const PAYMENT_CASH = 'cash';
    const PAYMENT_DEFFERED = 'deffered';

    protected $fillable = ['name', 'phone', 'email', 'store_name', 'address', 'lat', 'lng', 'image', 'notes', 'is_active', 'code', 'route_id', 'user_id', 'client_class_id', 'tax_number', 'payment_type'
    ];
     /**
      * The accessors to append to the model's array form.
      *
      * @var array
      */
     protected $appends = [''];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault('user_id');
    }

    public function route()
    {
        return $this->belongsTo(DistributorRoute::class, 'route_id')->withDefault('route_id');
    }

    public function client_class()
    {
        return $this->belongsTo(ClientClass::class, 'client_class_id')->withDefault(new ClientClass);
    }

    public function inventory()
    {
        return $this->hasManyThrough(TripInventory::class, RouteTrips::class, 'client_id', 'route_trip_id');
    }

    public function tripsReport()
    {
        return $this->hasManyThrough(RouteTripReport::class, RouteTrips::class, 'client_id', 'route_trip_id');
    }

    public function sender_transactions()
    {
        return $this->morphMany(DistributorTransaction::class, 'sender');
    }

    public function receiver_transactions()
    {
        return $this->morphMany(DistributorTransaction::class, 'receiver');
    }

    public function invoices()
    {
        return $this->hasManyThrough(RouteTripReport::class, RouteTrips::class, 'client_id', 'route_trip_id')->latest();
    }

    public function getIsBlockedAttribute()
    {
        return (
            $this->tripsReport()
            ->whereDate('route_trip_reports.created_at', '<=', Carbon::now()->subWeek())
            ->where('paid_at', null)->exists()
        &&
            $this->payment_type == static::PAYMENT_DEFFERED);
    }
}

<?php

namespace App\Models;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Client
 *
 * @property int $id
 * @property string $name
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $store_name
 * @property string $address
 * @property string $lat
 * @property string $lng
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $image
 * @property int $is_active
 * @property string|null $code
 * @property int|null $route_id
 * @property int|null $user_id
 * @property int|null $client_class_id
 * @property string|null $tax_number
 * @property string|null $notes
 * @property string $payment_type
 * @property-read \App\Models\ClientClass|null $client_class
 * @property-read mixed $is_blocked
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TripInventory[] $inventory
 * @property-read int|null $inventory_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RouteTripReport[] $invoices
 * @property-read int|null $invoices_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DistributorTransaction[] $receiver_transactions
 * @property-read int|null $receiver_transactions_count
 * @property-read \App\Models\DistributorRoute|null $route
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DistributorTransaction[] $sender_transactions
 * @property-read int|null $sender_transactions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RouteTripReport[] $tripsReport
 * @property-read int|null $trips_report_count
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereClientClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereRouteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereStoreName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereTaxNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUserId($value)
 * @mixin \Eloquent
 */
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

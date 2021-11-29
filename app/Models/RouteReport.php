<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RouteReport
 *
 * @property int $id
 * @property int $route_id
 * @property string $cash
 * @property string $expenses
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $user_id
 * @property int $round
 * @property-read mixed $invoice_number
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AttachedProducts[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\RouteTrips $routetrip
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|RouteReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RouteReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RouteReport query()
 * @method static \Illuminate\Database\Eloquent\Builder|RouteReport whereCash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteReport whereExpenses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteReport whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteReport whereRound($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteReport whereRouteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteReport whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteReport whereUserId($value)
 * @mixin \Eloquent
 */
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

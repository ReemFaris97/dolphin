<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [ 'name', 'phone', 'email', 'store_name', 'address', 'lat', 'lng','image',
        'is_active', 'code', 'route_id', 'user_id', 'client_class_id', 'tax_number'
    ];

    public function user()
    {
        return $this->belongsTo( User::class,'user_id')->withDefault('user_id');
    }
    public function route()
    {
        return $this->belongsTo(DistributorRoute::class,'route_id')->withDefault('route_id');
    }
    public function client_class()
    {
        return $this->belongsTo(ClientClass::class, 'client_class_id')->withDefault(new ClientClass);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [ 'name', 'phone', 'email', 'store_name', 'address', 'lat', 'lng','image',
    'is_active','code','route_id','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function route()
    {
        return $this->belongsTo(DistributorRoute::class,'route_id');
    }

}

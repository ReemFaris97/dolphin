<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class RouteTrips extends Model
{
    protected $fillable = [ 'route_id', 'client_id', 'lat', 'lng', 'address', 'status' , 'arrange','cash'];

    protected $appends = ['total'];
    public function route()
    {
        return $this->belongsTo(DistributorRoute::class,'route_id')->withDefault();
    }
    public function client()
    {

        return $this->belongsTo(Client::class,'client_id')->withDefault();
    }
    public function images()
    {
        return $this->morphMany(Image::class,'model');
    }

    public function products()
    {
        return $this->morphMany(AttachedProducts::class,'model');
    }

    public function inventory()
    {
        return $this->hasOne(TripInventory::class,'trip_id');
    }

    public function steps()
    {
        if(!$this->inventory) $status = "inventory";
        elseif (!$this->products->first()) $status ="bill";
        elseif(!$this->images->first()) $status="images";
        else $status = "finished";
        return $status;

    }

    public function getTotalAttribute()
    {
        $total = 0;
        foreach ($this->products as $product)
        {
            $total += $product->price * $product->quantity;
        }
        return $total;
    }


}

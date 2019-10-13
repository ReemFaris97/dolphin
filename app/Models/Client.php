<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [ 'name', 'phone', 'email', 'store_name', 'address', 'lat', 'lng','image','is_active'];

}

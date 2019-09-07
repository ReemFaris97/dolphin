<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreCategory extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

    public function stores(){
        return $this->hasMany(Store::class);
    }
}

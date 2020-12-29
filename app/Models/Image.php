<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['image','user_id'];

    public function model()
    {
        return $this->morphTo();
    }
}

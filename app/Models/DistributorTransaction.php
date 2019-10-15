<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DistributorTransaction extends Model
{
    use SoftDeletes;

    protected $fillable = ['sender_id', 'receiver_id', 'amount','is_received','signature'];

    public function sender()
    {
        return $this->belongsTo(User::class,'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class,'receiver_id');
    }
}

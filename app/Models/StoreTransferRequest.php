<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreTransferRequest extends Model
{
    use SoftDeletes;

    protected $fillable= ['sender_id', 'distributor_id', 'is_confirmed'];

    public function sender()
    {
        return $this->belongsTo(User::class,'sender_id');
    }

    public function distributor(){
        return $this->belongsTo(User::class,'distributor_id');
    }

    public function products()
    {
        return $this->morphMany(AttachedProducts::class,'model');
    }

    public function confirmRequest()
    {
       $this->update(['is_confirmed' => 1]);
    }
}

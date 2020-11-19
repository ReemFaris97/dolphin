<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClauseLog extends Model
{
    protected $fillable = [ 'user_id', 'clause_id', 'amount'];


    protected $casts=['amount'=>'float'];

    public function clause()
    {
        return $this->belongsTo(Clause::class, 'clause_id');

    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');

    }
}

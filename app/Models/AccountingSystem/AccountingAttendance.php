<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingAttendance extends Model
{
    protected $fillable=['typeable_type','typeable_id','type','date'];
    public function typeable(){
        return $this->morphTo('typeable');
    }
}

<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingBonusDiscount extends Model
{
    protected $fillable = ['typeable_id','typeable_type', 'type', 'date', 'value', 'notes','reason'];

    public function typeable(){
        return $this->morphTo('typeable_type');
    }
}

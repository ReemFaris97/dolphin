<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingDevice extends Model
{
    protected $fillable = ['store_id','name','code','model_id','model_type','available'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        parent::booted();
        static::created(function (AccountingDevice $device) {
            $device->fund()->create([
    'name'=>$device->name,
    'name_en'=>$device->name,
    'branch_id'=>$device->model_id,


            ]);
        });
    }
    public function clause()
    {
        return $this->belongsTo(AccountingMoneyClause::class, 'clause_id');
    }

    public function branch()
    {
        return $this->belongsTo(AccountingBranch::class, 'model_id');
    }


    public function fund()
    {
        return $this->morphOne(AccountingFund::class, 'created_by');
    }
}

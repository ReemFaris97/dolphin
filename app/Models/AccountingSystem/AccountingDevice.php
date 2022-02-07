<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingDevice extends Model
{
    protected $fillable = [
        "store_id",
        "name",
        "code",
        "model_id",
        "model_type",
        "available",
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        parent::booted();
        static::created(function (AccountingDevice $device) {
            $device->createFund();
        });
    }
    public function clause()
    {
        return $this->belongsTo(AccountingMoneyClause::class, "clause_id");
    }

    public function branch()
    {
        return $this->belongsTo(AccountingBranch::class, "model_id");
    }

    public function fund()
    {
        return $this->morphOne(AccountingFund::class, "created_by");
    }

    public function createFund(): AccountingFund
    {
        return $this->fund()->create([
            "name" => $this->name,
            "name_en" => $this->name,
            "branch_id" => $this->model_id,
            "company_id" => $this->branch?->company_id,
            "is_bank" => 0,
            "description" => "Created by Device",
        ]);
    }
}

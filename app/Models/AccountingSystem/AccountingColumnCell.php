<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingColumnCell extends Model
{
    protected $fillable = ['column_id','name'];

    public function face()
    {
        return $this->belongsTo(AccountingFaceColumn::class,'column_id');
    }
}

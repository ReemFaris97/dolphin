<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingColumnCell extends Model
{
    protected $fillable = ['column_id','name','empty'];



    public function column ()
    {
        return $this->belongsTo(AccountingFaceColumn::class,'column_id');
    }
}

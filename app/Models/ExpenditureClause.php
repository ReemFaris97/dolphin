<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenditureClause extends Model
{
    protected $fillable = ['name','expenditure_type_id','is_active'];
    public function type()
    {
        return $this->belongsTo(ExpenditureType::class,'expenditure_type_id');
    }
}

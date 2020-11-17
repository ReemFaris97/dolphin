<?php

namespace App\Models;

use App\Models\ExpenditureClause;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['user_id','expenditure_clause_id', 'expenditure_type_id', 'date', 'time', 'amount', 'image', 'notes', 
    'sanad_No','reader_number', 'reader_id',];


    public function clause()
    {
        return $this->belongsTo(ExpenditureClause::class,'expenditure_clause_id');
    }

    public function type()
    {
        return $this->belongsTo(ExpenditureType::class,'expenditure_type_id');
    }

    public function reader()
    {
        return $this->belongsTo(Reader::class,'reader_id')->withDefault();
    }
    public function setDateAttribute($value)
    {
        $this->attributes['date'] =  Carbon::parse($value);
    }
}

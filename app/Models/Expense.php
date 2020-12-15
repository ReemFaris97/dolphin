<?php

namespace App\Models;

use App\Models\ExpenditureClause;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['user_id','expenditure_clause_id', 'expenditure_type_id', 'date', 'time', 'amount', 'image', 'notes',
        'sanad_No', 'reader_number', 'reader_id', 'reader_image', 'distributor_route_id', 'round','has_reader'
    ];

    public function clause()
    {
        return $this->belongsTo(ExpenditureClause::class,'expenditure_clause_id');
    }

    public function distributor()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function type()
    {
        return $this->belongsTo(ExpenditureType::class,'expenditure_type_id');
    }

    public function reader()
    {
        return $this->belongsTo(Reader::class,'reader_id')->withDefault();
    }
    public function distributor_route()
    {
        return $this->belongsTo(DistributorRoute::class, 'distributor_route_id');
    }


    public function sender_transactions()
    {
        return $this->morphMany(DistributorTransaction::class, 'sender');
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] =  Carbon::parse($value);
    }


}

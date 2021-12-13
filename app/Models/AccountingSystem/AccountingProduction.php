<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingProduction extends Model
{
    use HasFactory;
    protected $table = 'accounting_productions';
    protected $fillable = ['company_id', 'production_line_id','status'];

    public function company()
    {
        return $this->belongsTo(AccountingCompany::class, 'company_id');
    }

    public function production_line()
    {
        return $this->belongsTo(AccountingProductionLine::class, 'production_line_id');
    }

    public function items()
    {
        return $this->hasMany(AccountingProductionItem::class,'production_id');
    }


}

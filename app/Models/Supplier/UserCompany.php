<?php

namespace App\Models\Supplier;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserCompany extends Pivot
{
    protected $table = 'suppliers_user_companies';
    use HasFactory;

    protected $fillable = ['accounting_company_id', 'user_id'];


}

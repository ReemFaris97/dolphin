<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingDelegate extends Model
{


    protected $fillable = ['name','email','phone','commission'
    ];
    protected $table='accounting_delegates';




}

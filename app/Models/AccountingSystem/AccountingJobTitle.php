<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingJobTitle extends Model
{


    protected $fillable = ['name','active'];
    protected $table='accounting_job_titles';




}


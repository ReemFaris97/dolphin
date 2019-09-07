<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsCode extends Model
{
    protected $fillable = ['id', 'code', 'receivable_type', 'receivable_id','type'];


}

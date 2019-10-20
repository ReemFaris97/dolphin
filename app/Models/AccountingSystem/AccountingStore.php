<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingStore extends Model
{
    use SoftDeletes;

    protected $fillable =['ar_name', 'en_name', 'address', 'image','model_id','model_type'];

    public function model()
    {
        return $this->morphTo();
    }
}

<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingFaceColumn extends Model
{
    protected $fillable = ['face_id','name'];

    public function face()
    {
        return $this->belongsTo(AccountingBranchFace::class,'face_id');
    }
}

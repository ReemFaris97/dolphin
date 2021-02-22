<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingDocument extends Model
{
  protected $fillable=[
      'documentable_type','documentable_id','document_name',
      'document_number','start_date','end_date','document',
      'notes','parent'];

    protected $dates = ['start_date','end_date'];

    public function documentable(){
        return $this->morphTo('documentable_type');
    }

    public function getUrlAttribute(){
        return getimg($this->attributes['document']);
    }
}

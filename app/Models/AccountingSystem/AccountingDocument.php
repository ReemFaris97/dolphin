<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingDocument
 *
 * @property int $id
 * @property string $documentable_type
 * @property int $documentable_id
 * @property string $document_name
 * @property string $document_number
 * @property \Illuminate\Support\Carbon|null $start_date
 * @property \Illuminate\Support\Carbon|null $end_date
 * @property string $document
 * @property string $notes
 * @property int $parent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $documentable
 * @property-read mixed $url
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDocument newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDocument newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDocument query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDocument whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDocument whereDocument($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDocument whereDocumentName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDocument whereDocumentNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDocument whereDocumentableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDocument whereDocumentableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDocument whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDocument whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDocument whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDocument whereParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDocument whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDocument whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingDocument extends Model
{
  protected $fillable=[
      'documentable_type','documentable_id','document_name',
      'document_number','start_date','end_date','document',
      'notes','parent'];

    protected $dates = ['start_date','end_date'];

    public function documentable(){
        return $this->morphTo();
    }

    public function getUrlAttribute(){
        return getimg($this->attributes['document']);
    }
}

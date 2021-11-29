<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingMoneyTransaction
 *
 * @property int $id
 * @property string $amount
 * @property string $model_type
 * @property int $model_id
 * @property int $clause_id
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AccountingSystem\AccountingMoneyClause $clause
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyTransaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyTransaction whereClauseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyTransaction whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyTransaction whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyTransaction whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyTransaction whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingMoneyTransaction extends Model
{
    protected  $fillable=['amount','model_type','model_id','clause_id','notes'];
    public  function clause(){
        return $this->belongsTo(AccountingMoneyClause::class,'clause_id');

    }

}

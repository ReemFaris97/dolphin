<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SupplierTransaction
 *
 * @property int $id
 * @property int $supplier_id
 * @property string $amount
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read User $supplier
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierTransaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierTransaction whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierTransaction whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierTransaction whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SupplierTransaction extends Model
{
    protected $guarded = ['id'];

    public function supplier(){
        return $this->belongsTo(User::class,'supplier_id');
    }



}

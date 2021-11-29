<?php

namespace App\Models\AccountingSystem;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingProductComponent
 *
 * @property int $id
 * @property int|null $product_id
 * @property string|null $name
 * @property string|null $quantity
 * @property string|null $main_unit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $component_id
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductComponent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductComponent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductComponent query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductComponent whereComponentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductComponent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductComponent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductComponent whereMainUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductComponent whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductComponent whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductComponent whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductComponent whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingProductComponent extends Model
{
    protected  $table='accounting_product_components';
    protected $fillable = ['name','product_id','quantity','main_unit'];
}

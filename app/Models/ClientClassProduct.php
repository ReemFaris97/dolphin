<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ClientClassProduct
 *
 * @property int $id
 * @property int $product_id
 * @property int $client_class_id
 * @property string|null $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ClientClassProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientClassProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientClassProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientClassProduct whereClientClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientClassProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientClassProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientClassProduct wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientClassProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientClassProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ClientClassProduct extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}

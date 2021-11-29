<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DistributorSale
 *
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorSale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorSale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorSale query()
 * @mixin \Eloquent
 */
class DistributorSale extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'distributors_sales';
}

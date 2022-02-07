<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingProductOffer
 *
 * @property int $id
 * @property int|null $parent_product_id
 * @property int|null $child_product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductOffer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductOffer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductOffer query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductOffer whereChildProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductOffer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductOffer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductOffer whereParentProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductOffer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingProductOffer extends Model
{
    protected $table = "accounting_product_offers";
    protected $fillable = ["parent_product_id", "child_product_id"];
}

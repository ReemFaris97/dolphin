<?php

namespace App\Models\AccountingSystem;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingInventoryProduct
 *
 * @property int $id
 * @property int|null $inventory_id
 * @property int|null $product_id
 * @property int|null $quantity
 * @property int|null $Real_quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $status
 * @property-read \App\Models\AccountingSystem\AccountingInventory|null $inventory
 * @property-read \App\Models\AccountingSystem\AccountingProduct|null $product
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventoryProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventoryProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventoryProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventoryProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventoryProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventoryProduct whereInventoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventoryProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventoryProduct whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventoryProduct whereRealQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventoryProduct whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventoryProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingInventoryProduct extends Model
{
    protected $fillable = [
        "inventory_id",
        "product_id",
        "quantity",
        "Real_quantity",
        "status",
    ];
    protected $table = "accounting_inventory_product";

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
    public function inventory()
    {
        return $this->belongsTo(AccountingInventory::class, "inventory_id");
    }
    public function product()
    {
        return $this->belongsTo(AccountingProduct::class, "product_id");
    }
}

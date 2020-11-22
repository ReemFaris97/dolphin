<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductQuantity extends Model
{
    protected $fillable = ['product_id', 'user_id', 'quantity', 'type', 'is_confirmed', 'store_id', 'store_transfer_request_id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id')->withDefault(new Product);
    }

    public function distributor()
    {
        return $this->belongsTo(User::class, 'product_id')->withDefault(new User);
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'product_id')->withDefault(new Store);
    }

    public function store_transfer_request()
    {
        return $this->belongsTo(StoreTransferRequest::class, 'store_transfer_request_id');
    }

    public function scopeTotalQuantity(Builder $query)
    {
        /* SELECT id,product_id, store_id,sum( CASE WHEN type != 'in' THEN (-1 * quantity) ELSE quantity END ) q FROM `product_quantities` where store_id=9 GROUP by product_id
 */
        $query->groupBy('product_id')
            ->select('*')
            ->addSelect(DB::raw("sum( CASE WHEN type != 'in' THEN (-1 * quantity) ELSE quantity END ) total_quantity"));
    }
    public function scopeFilterWithDates(Builder $builder, $from_date = null, $to_date = null)
    {
    }
    public function scopeFilterWithProduct(Builder $builder, $store_id = null)
    {
    }
    public function scopeFilterWithStore(Builder $builder, $store_id = null)
    {
    }

}

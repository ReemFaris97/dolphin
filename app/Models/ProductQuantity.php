<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductQuantity extends Model
{
    protected $fillable = ['product_id', 'user_id', 'quantity', 'type', 'is_confirmed', 'store_id', 'store_transfer_request_id', 'trip_report_id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id')->withDefault(new Product);
    }

    public function distributor()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault(new User);
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id')->withDefault(new Store);
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
    public function scopeFilterWithDates(Builder $builder, $from_date = null, $to_date = null): void
    {
        $builder->when($from_date, function (Builder $q) use ($from_date) {
            $q->whereDate('created_at', '<=', $from_date);
        });

        $builder->when($to_date, function (Builder $q) use ($to_date) {
            $q->whereDate('created_at', '>=', $to_date);
        });
    }
    public function scopeFilterWithProduct(Builder $builder, $product_id = null)
    {
        $builder->when($product_id, function (Builder $q) use ($product_id) {
            $q->whereDate('product_id', $product_id);
        });
    }
    public function scopeFilterWithStore(Builder $builder, $store_id = null)
    {

        $builder->when($store_id, function (Builder $q) use ($store_id) {
            $q->whereDate('store_id', $store_id);
        });
    }

}

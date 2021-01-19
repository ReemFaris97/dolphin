<?php

namespace App\Models;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductQuantity extends Model
{
    protected $fillable = ['product_id', 'user_id', 'quantity', 'type', 'is_confirmed', 'store_id', 'store_transfer_request_id', 'trip_report_id', 'image'];

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

    public function trip_report()
    {
        return $this->belongsTo(RouteTripReport::class, 'trip_report_id');
    }

    public function store_transfer_request()
    {
        return $this->belongsTo(StoreTransferRequest::class, 'store_transfer_request_id');
    }

    public function scopeTotalQuantity(Builder $query)
    {

        $query->groupBy(['product_id'])
            ->select('*')
            ->addSelect(DB::raw("sum(
             CASE
                WHEN type != 'in'
                THEN
                    (-1 * quantity)
                ELSE
                     quantity
                END
              ) total_quantity"));
    }

    public function scopeFilterWithDates(Builder $builder, $from_date = null, $to_date = null): void
    {
        $builder->when($from_date, function (Builder $q) use ($from_date) {
            $q->whereDate('created_at', '>=', Carbon::parse($from_date));
        });

        $builder->when($to_date, function (Builder $q) use ($to_date) {
            $q->whereDate('created_at', '<=', Carbon::parse($to_date));
        });
    }

    public function scopeFilterWithProduct(Builder $builder, $product_id = null)
    {
        $builder->when($product_id, function (Builder $q) use ($product_id) {
            $q->where('product_id', $product_id);
        });
    }

    public function scopeFilterWithStore(Builder $builder, $store_id = null)
    {

        $builder->when($store_id, function (Builder $q) use ($store_id) {
            $q->where('store_id', $store_id);
        });
    }


    public function getMovementTypeAttribute()
    {

        if ($this->type == 'in' && $this->store_transfer_request_id == null) {
            return 'انتاج(+) ';
        }

        if ($this->type == 'in' && $this->store_transfer_request_id != null) {
            return ' استلام (+) ';
        }

        if ($this->type == 'out' && $this->store_transfer_request_id != null) {
            return 'نقل  (-) ';
        }
        if ($this->type == 'out' && $this->store_transfer_request_id === null && $this->trip_report_id != null) {
            return 'بيع (-) ';
        }
        if ($this->type == 'out' && $this->store_transfer_request_id === null && $this->trip_report_id == null) {
            return 'بيع (-) ';
        }
        if ($this->type == 'damaged') {
            return 'اتلاف (-)';
        }
        dd($this->type, $this->store_transfer_request_id, $this->trip_report_id);
        //check $this->type,$this->store_transfer_request_id ,$this->trip_report_id
        throw new Exception('Unhandled Type');
    }


}

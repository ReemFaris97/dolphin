<?php

namespace App\Models;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\ProductQuantity
 *
 * @property int $id
 * @property int $product_id
 * @property int|null $user_id
 * @property int $quantity
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $type
 * @property int $is_confirmed
 * @property int|null $store_id
 * @property int|null $store_transfer_request_id
 * @property int|null $trip_report_id
 * @property string|null $image
 * @property int|null $route_trip_id
 * @property int|null $round
 * @property-read User|null $distributor
 * @property-read mixed $movement_type
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\Store|null $store
 * @property-read \App\Models\StoreTransferRequest|null $store_transfer_request
 * @property-read \App\Models\RouteTripReport|null $trip_report
 * @method static Builder|ProductQuantity filterWithDates($from_date = null, $to_date = null)
 * @method static Builder|ProductQuantity filterWithProduct($product_id = null)
 * @method static Builder|ProductQuantity filterWithStore($store_id = null)
 * @method static Builder|ProductQuantity newModelQuery()
 * @method static Builder|ProductQuantity newQuery()
 * @method static Builder|ProductQuantity query()
 * @method static Builder|ProductQuantity totalQuantity()
 * @method static Builder|ProductQuantity whereCreatedAt($value)
 * @method static Builder|ProductQuantity whereDeletedAt($value)
 * @method static Builder|ProductQuantity whereId($value)
 * @method static Builder|ProductQuantity whereImage($value)
 * @method static Builder|ProductQuantity whereIsConfirmed($value)
 * @method static Builder|ProductQuantity whereProductId($value)
 * @method static Builder|ProductQuantity whereQuantity($value)
 * @method static Builder|ProductQuantity whereRound($value)
 * @method static Builder|ProductQuantity whereRouteTripId($value)
 * @method static Builder|ProductQuantity whereStoreId($value)
 * @method static Builder|ProductQuantity whereStoreTransferRequestId($value)
 * @method static Builder|ProductQuantity whereTripReportId($value)
 * @method static Builder|ProductQuantity whereType($value)
 * @method static Builder|ProductQuantity whereUpdatedAt($value)
 * @method static Builder|ProductQuantity whereUserId($value)
 * @mixin \Eloquent
 */
class ProductQuantity extends Model
{
    protected $fillable = ['product_id', 'user_id', 'quantity', 'type', 'is_confirmed', 'store_id', 'store_transfer_request_id', 'trip_report_id', 'route_trip_id', 'round', 'image'];

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
        //check $this->type,$this->store_transfer_request_id ,$this->trip_report_id
        throw new Exception('Unhandled Type');
    }


}

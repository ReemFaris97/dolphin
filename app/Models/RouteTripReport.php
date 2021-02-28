<?php

namespace App\Models;

use App\Http\Helpers\num_to_ar;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RouteTripReport extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'route_trip_id',
        'round',
        'cash',
        'notes',
        'store_id',
        'distributor_transaction_id',
        'expenses'
    ];

    /**
     * distributor_transaction relation
     *
     * @return BelongsTo
     */
    public function distributor_transaction(): BelongsTo
    {
        return $this->belongsTo(DistributorTransaction::class, 'distributor_transaction_id');
    }

    /**
     * route_trip relation
     *
     * @return BelongsTo
     */
    public function route_trip(): BelongsTo
    {
        return $this->belongsTo(RouteTrips::class, 'route_trip_id');
    }

    public function store()
    {
        return $this->belongsTo(store::class, 'store_id')->withDefault();
    }

    public function inventory(): HasOne
    {
        return $this->hasOne(TripInventory::class, 'trip_id', 'route_trip_id')->whereColumn('trip_inventories.round', 'round');
    }

    public function products()
    {
        return $this->morphMany(AttachedProducts::class, 'model')->with('product');
    }

    public function product_total()
    {
        $products = $this->morphMany(AttachedProducts::class, 'model')->with('product');
        $total = 0;
//      dd($products->get());
        foreach ($products->get() as $item) {
            $sum = $item->price * $item->quantity;
            $total += $sum;
        }
//        dd($total);
        return $total;
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'model');
    }

    public function scopeOfDistributor(Builder $builder, $distributor = null): void
    {
        $builder->whereHas('route_trip', function ($route_trip) use ($distributor) {


            $route_trip->OfDistributor($distributor);
        });
    }

    public function scopeWithProductsPrice(Builder $builder)
    {
        $builder->join(
            DB::raw(
                "(
                    select model_id as route_trip_id,
                    SUM(price *quantity) as products_price,
                    product_id
                    from attached_products
                    where model_type= 'App\\\\Models\\\\RouteTripReport'
                    group by model_id ,product_id
                ) as attached_products"
            ),
            'attached_products.route_trip_id',
            'route_trip_reports.id'
        );
    }

    public function scopeFilterDistributor(Builder $builder, $distributor = null): void
    {
        $builder->when($distributor != null, function ($q) use ($distributor) {
            $q->ofDistributor($distributor);
        });
    }

    public function scopeOfClient(Builder $builder, $client = null): void
    {

        $builder->whereHas('route_trip', function ($route_trip) use ($client) {
            $route_trip->where('client_id', $client);
        });

    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param mixed|null $year
     * @return void
     */
    public function scopeOfYear(Builder $builder, $year = null): void
    {
        $builder->when($year != null, function ($q) use ($year) {
            $q->whereYear('created_at', $year);
        });
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param mixed|null $month
     * @return void
     */
    public function scopeOfMonth(Builder $builder, $month = null): void
    {
        $builder->when($month != null, function ($q) use ($month) {
            $q->whereMonth('created_at', $month);
        });
    }


    public function getInvoiceNumberAttribute()
    {
        return str_pad($this->id, 6, 0, STR_PAD_LEFT);
    }

    public function CashArabic($cach)
    {
        $total = explode(".", $cach);
        $total_in_arabic_rial = new  num_to_ar($total[0], "male");
        $total_in_arabic_halla = new  num_to_ar($total[1] ?? 0, "male");
        $AllTotal = [$total_in_arabic_rial->convert_number(), $total_in_arabic_halla->convert_number() ?? 0];
        return $AllTotal;
    }
}

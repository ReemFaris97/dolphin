<?php

namespace App\Models;

use App\helper\num_to_ar;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\RouteTripReport
 *
 * @property int $id
 * @property int $route_trip_id
 * @property int $store_id
 * @property int $round
 * @property string|null $cash
 * @property string|null $visa
 * @property string|null $total_money
 * @property string|null $notes
 * @property int|null $distributor_transaction_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $expenses
 * @property \Illuminate\Support\Carbon|null $paid_at
 * @property-read \App\Models\DistributorTransaction|null $distributor_transaction
 * @property-read mixed $invoice_number
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @property-read \App\Models\TripInventory|null $inventory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AttachedProducts[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\RouteTrips $route_trip
 * @property-read \App\Models\Store $store
 * @method static Builder|RouteTripReport filterDistributor($distributor = null)
 * @method static Builder|RouteTripReport newModelQuery()
 * @method static Builder|RouteTripReport newQuery()
 * @method static Builder|RouteTripReport ofClient($client = null)
 * @method static Builder|RouteTripReport ofDistributor($distributor = null)
 * @method static Builder|RouteTripReport ofMonth($month = null)
 * @method static Builder|RouteTripReport ofYear($year = null)
 * @method static Builder|RouteTripReport query()
 * @method static Builder|RouteTripReport whereCash($value)
 * @method static Builder|RouteTripReport whereCreatedAt($value)
 * @method static Builder|RouteTripReport whereDistributorTransactionId($value)
 * @method static Builder|RouteTripReport whereExpenses($value)
 * @method static Builder|RouteTripReport whereId($value)
 * @method static Builder|RouteTripReport whereNotes($value)
 * @method static Builder|RouteTripReport wherePaidAt($value)
 * @method static Builder|RouteTripReport whereRound($value)
 * @method static Builder|RouteTripReport whereRouteTripId($value)
 * @method static Builder|RouteTripReport whereStoreId($value)
 * @method static Builder|RouteTripReport whereTotalMoney($value)
 * @method static Builder|RouteTripReport whereUpdatedAt($value)
 * @method static Builder|RouteTripReport whereVisa($value)
 * @method static Builder|RouteTripReport withProductsPrice()
 * @mixin \Eloquent
 */
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
        'visa',
        'store_id',
        'distributor_transaction_id',
        'expenses',
        'paid_at',
        'is_packages',
    ];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'paid_at'];
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!request()->is_deffered == 1) {
                $model->paid_at = Carbon::now();
            }
            $model->is_packages=request()->is_packages??0;
        });
    }

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
        $total = 0;

        foreach ($this->products as $item) {
            $sum = $item->price * $item->quantity;
            $total += $sum;
        }
        return round($total, 2);
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
                    select model_id as route_trip,
                    SUM(price *quantity) as products_price,
                    SUM(quantity) as total_quantity,
                    price ,
                    product_id
                    from attached_products
                    where model_type= 'App\\\\Models\\\\RouteTripReport'
                    group by model_id ,product_id
                ) as attached_products"
            ),
            'attached_products.route_trip',
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
        $total = explode('.', $cach);
        $total_in_arabic_rial = new  num_to_ar($total[0], 'male');
        $total_in_arabic_halla = new  num_to_ar($total[1] ?? 0, 'male');
        $AllTotal = [$total_in_arabic_rial->convert_number(), $total_in_arabic_halla->convert_number() ?? 0];
        return $AllTotal;
    }
    public function getClientNameAttribute()
    {
        return @$this->route_trip->client->name;
    }
    public function getTotalWithTaxAttribute()
    {
        $tax_percent=(float)(getsetting('general_taxs')) /100;
        $tax_amount= round($this->product_total() * $tax_percent, 2);
        return $$this->product_total() + $tax_amount;
    }
}

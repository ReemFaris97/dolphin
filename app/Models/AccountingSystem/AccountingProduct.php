<?php

namespace App\Models\AccountingSystem;

use App\Models\Supplier\SupplierProduct;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingProduct
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $type
 * @property int $is_active
 * @property int|null $category_id
 * @property int|null $cell_id
 * @property array|null $bar_code
 * @property string $main_unit
 * @property string $selling_price
 * @property string $purchasing_price
 * @property string $min_quantity
 * @property string $max_quantity
 * @property string|null $expired_at
 * @property string|null $image
 * @property string|null $size
 * @property string|null $color
 * @property string|null $height
 * @property string|null $width
 * @property int|null $num_days_recession
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $store_id
 * @property int|null $industrial_id
 * @property string|null $unit_price
 * @property string|null $quantity
 * @property string|null $wholesale_price
 * @property int $is_settlement
 * @property string $date_settlement
 * @property int|null $settlement_store_id
 * @property \App\Models\AccountingSystem\AccountingColumnCell|null $cell
 * @property int|null $column_id
 * @property string|null $alert_duration
 * @property int|null $supplier_id
 * @property int|null $account_id
 * @property string|null $en_name
 * @property-read \App\Models\AccountingSystem\AccountingAccount|null $account
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingProductBarcode[] $barcodes
 * @property-read int|null $barcodes_count
 * @property-read \App\Models\AccountingSystem\AccountingProductCategory|null $category
 * @property-read \App\Models\AccountingSystem\AccountingColumnCell|null $cell_product
 * @property-read \Illuminate\Database\Eloquent\Collection|AccountingProduct[] $components
 * @property-read int|null $components_count
 * @property-read mixed $text
 * @property-read mixed $total_discounts
 * @property-read mixed $total_taxes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingSaleItem[] $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingSaleItem[] $sales
 * @property-read int|null $sales_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingSale[] $sold_items
 * @property-read int|null $sold_items_count
 * @property-read \App\Models\AccountingSystem\AccountingStore|null $store
 * @property-read \App\Models\AccountingSystem\AccountingStore|null $storeSettlement
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingStore[] $stores
 * @property-read int|null $stores_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingProductSubUnit[] $sub_units
 * @property-read int|null $sub_units_count
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct ofBarcode($barcode)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereAlertDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereBarCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereCell($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereCellId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereColumnId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereDateSettlement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereEnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereIndustrialId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereIsSettlement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereMainUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereMaxQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereMinQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereNumDaysRecession($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct wherePurchasingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereSellingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereSettlementStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereWholesalePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereWidth($value)
 * @mixin \Eloquent
 */
class AccountingProduct extends Model
{
    protected $fillable = ['name', 'en_name', 'description', 'type', 'is_active', 'category_id',
        'column_id', 'bar_code', 'main_unit', 'selling_price', 'purchasing_price', 'min_quantity',
        'max_quantity', 'expired_at', 'image', 'store_id','price_has_tax'
        , 'size', 'color', 'height', 'width', 'num_days_recession', 'industrial_id', 'quantity', 'unit_price',
        'is_settlement', 'date_settlement', 'settlement_store_id', 'cell_id', 'alert_duration', 'supplier_id', 'account_id','discount'

    ];
    protected $appends = ['total_taxes', 'total_discounts', 'text'];
    protected $casts = ['bar_code' => 'json'];

    public function components()
    {
        return $this->belongsToMany(AccountingProduct::class, AccountingProductComponent::class, 'product_id', 'component_id');
    }

    public function getTextAttribute()
    {
        return $this->name;
    }

    public function cell_product()
    {
        return $this->belongsTo(AccountingColumnCell::class, 'cell_id');
    }

    public function cell()
    {
        return $this->belongsTo(AccountingColumnCell::class, 'cell_id');
    }
    public function store()
    {
        return $this->belongsTo(AccountingStore::class, 'store_id');
    }
    public function stores()
    {
        return $this->belongsToMany(AccountingStore::class, 'accounting_product_stores', 'product_id', 'store_id');
    }
    public function storeSettlement()
    {
        return $this->belongsTo(AccountingStore::class, 'settlement_store_id');
    }
    public function category()
    {
        return $this->belongsTo(AccountingProductCategory::class, 'category_id');
    }
    public function barcodes()
    {
        return $this->hasMany(AccountingProductBarcode::class, 'product_id');
    }

    public function ProductComponent()
    {
//        return $this->belongsToMany(AccountingProduct::class,AccountingProductComponent::class);
    }



    public function getTotalTaxesAttribute()
    {
        $taxs=AccountingProductTax::where('product_id', $this->id)->get();
        $total = 0;
        foreach ($taxs as $tax) {
            $total+=optional($tax->Taxband)->percent;
        }
        return $total;
    }

    public function getTotalQuantities()
    {
        $units=AccountingProductSubUnit::where('product_id', $this->id)->get();
        $totalQuantity = 0;
        foreach ($units as $unit) {
            try {
                $totalQuantity+=$unit->quantity*$unit->main_unit_present;
            } catch (\Exception $e) {
                //انا اسف والله
            }
        }
        return $totalQuantity + $this->quantity;
    }


    public function account()
    {
        return $this->belongsTo(AccountingAccount::class, 'account_id');
    }

    public function tax()
    {
        return $this->belongsToMany(AccountingTaxBand::class, AccountingProductTax::class, 'product_id', 'tax_band_id');
    }

    public function discounts()
    {
        return $this->hasMany(AccountingProductDiscount::class, 'product_id');
    }

    public function getTotalDiscountsAttribute()
    {
        $discounts = AccountingProductDiscount::where('product_id', $this->id)->get();
        $total = 0;
        foreach ($discounts as $discount) {
            $total += $discount->percent;
        }
        return $total;
    }


    public function items()
    {
        return $this->hasMany(AccountingSaleItem::class, 'product_id');
    }

    public function purchase()
    {
        return $this->hasMany(AccountingPurchaseItem::class, 'product_id');
    }

    public function damage()
    {
        return $this->hasMany(AccountingDamageProduct::class, 'product_id');
    }

    public function quantity()
    {
        return $this->hasMany(AccountingProductStore::class, 'product_id')->sum('quantity');
    }
    public function sold_items()
    {
        return $this->hasManyThrough(
            AccountingSale::class,
            AccountingSaleItem::class,
            'product_id',
            'sale_id'
        )->latest();
    }

    public function sub_units()
    {
        return $this->hasMany(AccountingProductSubUnit::class, 'product_id');
    }

    public function sales()
    {
        return $this->hasMany(AccountingSaleItem::class)->whereHas('sale', function ($q) {
            $q->where('store_id', 1);
        });
    }
    public function store_quantity($store_id=null)
    {
        $quantity=AccountingProductStore::where('store_id', $store_id)->where('product_id', $this->id)->sum('quantity');
        return $quantity;
    }

    public function scopeOfBarcode($builder, ?string $barcode=null)
    {
        $builder->whereJsonContains('bar_code', $barcode);
        $builder->orwhereHas(
            'sub_units',
            fn ($b) => $b->whereJsonContains('bar_code', $barcode)
        );
    }

    public function scopeCreation()
    {
        return $this->where('type', 'creation');
    }

    public function suppliers()
    {
        return $this->belongsToMany(AccountingSupplier::class, SupplierProduct::class);
    }

    public function scopeForSales(Builder $builder, $from, $to):void
    {
        $builder->whereHas('items', fn ($q) =>$q->inPeriod($from, $to));
        $builder->with(['items' =>fn ($q) =>$q->inPeriod($from, $to)]);
    }

    public function scopeForPurchase(Builder $builder, $from, $to):void
    {
        $builder->whereHas('purchase', fn ($q) =>$q->inPeriod($from, $to));
        $builder->with('purchase', fn ($q) =>$q->inPeriod($from, $to));
    }

    public function scopeForDamage(Builder $builder, $from, $to):void
    {
        $builder->whereHas('damage', fn ($q) =>$q->inPeriod($from, $to));
        $builder->with('damage', fn ($q) =>$q->inPeriod($from, $to));
    }

    public function scopeHaveMovementBetween(Builder $builder, $from, $to)
    {
        $builder->where(fn ($q) =>$q->ForSales($from, $to))   ;
        $builder->orWhere(fn ($q) =>$q->ForPurchase($from, $to))   ;
        $builder->orWhere(fn ($q) =>$q->ForDamage($from, $to))   ;
        $builder->with([
            'items' =>fn ($q) =>$q->inPeriod($from, $to),
            'damage' =>fn ($q) =>$q->inPeriod($from, $to),
            'purchase' =>fn ($q) =>$q->inPeriod($from, $to)
        ]);
        // $builder->withCount('items');
        // $builder->withSum('items', 'quantity');
        // $builder->withCount('purchase');
        // $builder->withSum('purchase', 'quantity');
        // $builder->withCount('damage');
        // $builder->withSum('damage', 'quantity');
        // $builder->;
    }
}


/* select * from `accounting_products` where ((exists (select * from `accounting_sales_items` where `accounting_products`.`id` = `accounting_sales_items`.`product_id` and DATE(created_at) between '2021-12-02' and '2021-12-02')) or (exists (select * from `accounting_purchases_items` where `accounting_products`.`id` = `accounting_purchases_items`.`product_id` and DATE(created_at) between '2021-12-02' and '2021-12-02')) or (exists (select * from `accounting_damages_products` where `accounting_products`.`id` = `accounting_damages_products`.`product_id` and DATE(created_at) between '2021-12-02' and '2021-12-02'))) */

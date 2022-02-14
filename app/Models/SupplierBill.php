<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SupplierBill
 *
 * @property int $id
 * @property int $user_id
 * @property string $bill_number
 * @property string $date
 * @property int $supplier_id
 * @property string $payment_method
 * @property string $vat
 * @property string $amount_paid
 * @property string $amount_rest
 * @property string|null $transfer_date
 * @property string|null $transfer_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $bank_name
 * @property string|null $check_number
 * @property string|null $check_date
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SupplierBillProduct[] $products
 * @property-read int|null $products_count
 * @property-read User $supplier
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill query()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill whereAmountPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill whereAmountRest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill whereBankName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill whereBillNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill whereCheckDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill whereCheckNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill whereTransferDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill whereTransferNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill whereVat($value)
 * @mixin \Eloquent
 */
class SupplierBill extends Model
{
    protected $guarded = ["id"];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
    public function supplier()
    {
        return $this->belongsTo(User::class, "supplier_id");
    }

    public function total(): float
    {
        $total = $this->amount_paid + $this->amount_rest + $this->vat;
        return $total;
    }

    public function products()
    {
        return $this->hasMany(SupplierBillProduct::class, "supplier_bill_id");
    }
}

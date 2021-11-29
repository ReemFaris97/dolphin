<?php

namespace App\Models;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * App\Models\DailyReport
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $cash
 * @property string|null $expenses
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $store_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AttachedProducts[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\Store $store
 * @property-read User $user
 * @method static Builder|DailyReport filterWithDates($from_date = null, $to_date = null)
 * @method static Builder|DailyReport newModelQuery()
 * @method static Builder|DailyReport newQuery()
 * @method static \Illuminate\Database\Query\Builder|DailyReport onlyTrashed()
 * @method static Builder|DailyReport query()
 * @method static Builder|DailyReport whereCash($value)
 * @method static Builder|DailyReport whereCreatedAt($value)
 * @method static Builder|DailyReport whereDeletedAt($value)
 * @method static Builder|DailyReport whereExpenses($value)
 * @method static Builder|DailyReport whereId($value)
 * @method static Builder|DailyReport whereImage($value)
 * @method static Builder|DailyReport whereStoreId($value)
 * @method static Builder|DailyReport whereUpdatedAt($value)
 * @method static Builder|DailyReport whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|DailyReport withTrashed()
 * @method static \Illuminate\Database\Query\Builder|DailyReport withoutTrashed()
 * @mixin \Eloquent
 */
class DailyReport extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id','cash','expenses','image','store_id'];

    public function user()
    {

        return $this->belongsTo(User::class,'user_id')->withDefault('user_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class,'store_id')->withDefault('store_id');
    }

    public function products()
    {
        return $this->morphMany(AttachedProducts::class,'model');
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

}

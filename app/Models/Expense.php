<?php

namespace App\Models;

use App\Models\ExpenditureClause;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Expense
 *
 * @property int $id
 * @property int $expenditure_clause_id
 * @property int $expenditure_type_id
 * @property int $user_id
 * @property string $date
 * @property string $time
 * @property string $amount
 * @property string|null $image
 * @property string|null $notes
 * @property string|null $reader_name
 * @property string|null $reader_number
 * @property string|null $reader_image
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $reader_id
 * @property string|null $sanad_No
 * @property int $distributor_route_id
 * @property int $round
 * @property int $has_reader
 * @property-read ExpenditureClause $clause
 * @property-read \App\Models\User $distributor
 * @property-read \App\Models\DistributorRoute $distributor_route
 * @property-read mixed $name
 * @property-read \App\Models\Reader|null $reader
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DistributorTransaction[] $sender_transactions
 * @property-read int|null $sender_transactions_count
 * @property-read \App\Models\ExpenditureType $type
 * @method static \Illuminate\Database\Eloquent\Builder|Expense newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense query()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereDistributorRouteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereExpenditureClauseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereExpenditureTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereHasReader($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereReaderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereReaderImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereReaderName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereReaderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereRound($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereSanadNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereUserId($value)
 * @mixin \Eloquent
 */
class Expense extends Model
{
    protected $fillable = [
        "user_id",
        "expenditure_clause_id",
        "expenditure_type_id",
        "date",
        "time",
        "amount",
        "image",
        "notes",
        "sanad_No",
        "reader_number",
        "reader_id",
        "reader_image",
        "distributor_route_id",
        "round",
        "has_reader",
    ];

    public function clause()
    {
        return $this->belongsTo(
            ExpenditureClause::class,
            "expenditure_clause_id"
        )->withDefault(new ExpenditureClause());
    }

    public function distributor()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function type()
    {
        return $this->belongsTo(
            ExpenditureType::class,
            "expenditure_type_id"
        )->withDefault(new ExpenditureType());
    }

    public function reader()
    {
        return $this->belongsTo(Reader::class, "reader_id")->withDefault();
    }
    public function distributor_route()
    {
        return $this->belongsTo(
            DistributorRoute::class,
            "distributor_route_id"
        );
    }

    public function sender_transactions()
    {
        return $this->morphMany(DistributorTransaction::class, "sender");
    }

    public function setDateAttribute($value)
    {
        $this->attributes["date"] = Carbon::parse($value);
    }

    public function getNameAttribute()
    {
        return $this->type->name;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SmsCode
 *
 * @property int $id
 * @property string $code
 * @property string $receivable_type
 * @property int $receivable_id
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SmsCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SmsCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SmsCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|SmsCode whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmsCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmsCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmsCode whereReceivableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmsCode whereReceivableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmsCode whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmsCode whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SmsCode extends Model
{
    protected $fillable = [
        "id",
        "code",
        "receivable_type",
        "receivable_id",
        "type",
    ];
}

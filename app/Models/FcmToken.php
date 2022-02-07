<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FcmToken
 *
 * @property int $id
 * @property string $token
 * @property int $user_id
 * @property string $device
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FcmToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FcmToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FcmToken query()
 * @method static \Illuminate\Database\Eloquent\Builder|FcmToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FcmToken whereDevice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FcmToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FcmToken whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FcmToken whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FcmToken whereUserId($value)
 * @mixin \Eloquent
 */
class FcmToken extends Model
{
    protected $fillable = ["token", "user_id", "device"];
}

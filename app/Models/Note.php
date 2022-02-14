<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Note
 *
 * @property int $id
 * @property string $model_type
 * @property int $model_id
 * @property int $user_id
 * @property string $description
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @property-read Model|\Eloquent $model
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Note newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Note newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Note query()
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereUserId($value)
 * @mixin \Eloquent
 */
class Note extends Model
{
    protected $fillable = ["user_id", "description", "image"];

    public function model()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function images()
    {
        return $this->morphMany(Image::class, "model");
    }
}

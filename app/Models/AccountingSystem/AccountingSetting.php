<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Setting
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string $value
 * @property string $page
 * @property string $slug
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting wherePage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting whereValue($value)
 * @property string|null $accounting_type
 * @property string|null $height
 * @property string|null $display
 * @property string|null $up
 * @property string|null $dawn
 * @property string|null $right
 * @property string|null $left
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSetting whereAccountingType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSetting whereDawn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSetting whereDisplay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSetting whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSetting whereLeft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSetting whereRight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSetting whereUp($value)
 */
class AccountingSetting extends Model
{
    protected $fillable = ['name', 'type', 'value' , 'page', 'slug', 'title'];

    protected $table='accounting_settings';
    // public function value()
    // {
    //     if (app()->getLocale() == 'en')
    //         return $this->en_value;
    //     else
    //         return $this->ar_value;
    // }

}

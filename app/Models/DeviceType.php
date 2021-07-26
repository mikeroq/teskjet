<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\DeviceType
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceType query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DeviceType extends Model
{
    use HasFactory;
    public function devices() {
        return $this->hasMany('App\Models\Device');
    }
    protected $fillable = [
        'name'
    ];
}

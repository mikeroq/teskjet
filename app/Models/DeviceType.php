<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\DeviceType
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceType query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceType whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read Collection|Device[] $devices
 * @property-read int|null $devices_count
 * @property Carbon|null $deleted_at
 * @method static \Illuminate\Database\Query\Builder|DeviceType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceType whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|DeviceType withTrashed()
 * @method static \Illuminate\Database\Query\Builder|DeviceType withoutTrashed()
 */
class DeviceType extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function devices(): HasMany
    {
        return $this->hasMany('App\Models\Device');
    }
    protected $fillable = [
        'name'
    ];
}

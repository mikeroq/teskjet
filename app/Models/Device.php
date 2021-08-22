<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Device
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $brand_id
 * @property int $device_type_id
 * @property int $customer_id
 * @property string $model
 * @property string|null $serial_number
 * @property string $notes
 * @method static \Illuminate\Database\Eloquent\Builder|Device newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Device newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Device query()
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereDeviceTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereSerialNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read Brand $brand
 * @property-read Customer $customer
 * @property-read DeviceType $deviceType
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereDeletedAt($value)
 */
class Device extends Model
{
    use HasFactory;

    public function brand(): BelongsTo
    {
        return $this->belongsTo('App\Models\Brand');
    }
    public function deviceType(): BelongsTo
    {
        return $this->belongsTo('App\Models\DeviceType');
    }
    public function customer(): BelongsTo
    {
        return $this->belongsTo('App\Models\Customer');
    }
}

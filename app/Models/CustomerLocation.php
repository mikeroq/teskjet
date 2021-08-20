<?php

namespace App\Models;

use App\Traits\ConvertTimezone;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Propaganistas\LaravelPhone\Casts\E164PhoneNumberCast;
use Propaganistas\LaravelPhone\PhoneNumber;

/**
 * App\Models\CustomerLocation
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $customer_id
 * @property string $name
 * @property string $address
 * @property string $address_2
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $phone
 * @property-read Customer $customer
 * @method static Builder|CustomerLocation newModelQuery()
 * @method static Builder|CustomerLocation newQuery()
 * @method static Builder|CustomerLocation query()
 * @method static Builder|CustomerLocation whereAddress($value)
 * @method static Builder|CustomerLocation whereAddress2($value)
 * @method static Builder|CustomerLocation whereCity($value)
 * @method static Builder|CustomerLocation whereCreatedAt($value)
 * @method static Builder|CustomerLocation whereCustomerId($value)
 * @method static Builder|CustomerLocation whereId($value)
 * @method static Builder|CustomerLocation whereName($value)
 * @method static Builder|CustomerLocation wherePhone($value)
 * @method static Builder|CustomerLocation whereState($value)
 * @method static Builder|CustomerLocation whereUpdatedAt($value)
 * @method static Builder|CustomerLocation whereZip($value)
 * @mixin Eloquent
 */
class CustomerLocation extends Model
{
    use HasFactory, SoftDeletes, ConvertTimezone;

    protected $fillable = [
        'customer_id',
        'name',
        'address',
        'address_2',
        'city',
        'state',
        'zip',
        'phone'
    ];

    protected $casts = [
        'phone' => E164PhoneNumberCast::class.':US'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function getPhoneAttribute($attribute): string
    {
        if ($attribute === null) {
            return '';
        }
        return PhoneNumber::make($attribute, 'US')->formatNational();
    }
}
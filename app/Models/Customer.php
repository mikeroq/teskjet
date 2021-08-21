<?php

namespace App\Models;

use App\Traits\ConvertTimezone;
use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Laravelista\Comments\Commentable;
use Propaganistas\LaravelPhone\PhoneNumber;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Propaganistas\LaravelPhone\Casts\E164PhoneNumberCast;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**a
 * Customer
 *
 * @mixin Eloquent
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $name
 * @property string $phone
 * @property string $type
 * @property bool $taxable
 * @property int $default_address
 * @property int $shipping_address
 * @property int $billing_address
 * @property-read mixed $displayable_taxable
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereTaxable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUpdatedAt($value)
 * @property Carbon|null $deleted_at
 * @property-read Collection|Device[] $devices
 * @property-read int|null $devices_count
 * @property-read Collection|CustomerLocation[] $locations
 * @property-read int|null $locations_count
 * @property-read Collection|Ticket[] $tickets
 * @property-read int|null $tickets_count
 * @method static \Illuminate\Database\Query\Builder|Customer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Customer withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Customer withoutTrashed()
 */

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;
    use ConvertTimezone;
    use Commentable;
    use LogsActivity;

    protected $fillable = [
        'name',
        'phone',
        'type',
        'taxable',
        'default_address',
        'shipping_address',
        'billing_address'
    ];

    protected $casts = [
        'taxable' => 'boolean',
        'phone' => E164PhoneNumberCast::class.':US',
    ];

    protected $appends = [
        'displayable_taxable'
    ];

    public function getDisplayableTaxableAttribute(): string
    {
        return $this->taxable ? "Taxable" : "Non Taxable";
    }

    public function getTypeAttribute($attribute)
    {
        return collect(trans('types/customer.type'))->get($attribute);
    }
    public function devices(): HasMany
    {
        return $this->hasMany('App\Models\Device');
    }

    public function locations(): HasMany
    {
        return $this->hasMany('App\Models\CustomerLocation');
    }

    public function tickets(): HasMany
    {
        return $this->hasMany('App\Models\Ticket');
    }

    public function primaryContact(): BelongsTo
    {
        return $this->belongsTo('App\Models\CustomerContact', 'primary_contact');
    }

    public function primaryAddress(): BelongsTo
    {
        return $this->belongsTo('App\Models\CustomerLocation', 'default_address');
    }

    public function shippingAddress(): BelongsTo
    {
        return $this->belongsTo('App\Models\CustomerLocation', 'shipping_address');
    }

    public function billingAddress(): BelongsTo
    {
        return $this->belongsTo('App\Models\CustomerLocation', 'billing_address');
    }

    public function getPhoneAttribute($attribute): string
    {
        if ($attribute === null) {
            return '';
        }
        return PhoneNumber::make($attribute, 'US')->formatNational();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logFillable()->logOnlyDirty();
    }
}

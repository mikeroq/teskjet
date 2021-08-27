<?php

namespace App\Models;

use App\Traits\ConvertTimezone;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Laravelista\Comments\Comment;
use Laravelista\Comments\Commentable;
use Propaganistas\LaravelPhone\PhoneNumber;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Customer
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $name
 * @property string $phone
 * @property int $type
 * @property bool $taxable
 * @property Carbon|null $deleted_at
 * @property int $default_address
 * @property int $shipping_address
 * @property int $billing_address
 * @property int $primary_contact
 * @property-read Collection|Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read Collection|Comment[] $approvedComments
 * @property-read int|null $approved_comments_count
 * @property-read Collection|Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read Collection|Device[] $devices
 * @property-read int|null $devices_count
 * @property-read string $displayable_taxable
 * @property-read Collection|CustomerLocation[] $locations
 * @property-read int|null $locations_count
 * @property-read Collection|Ticket[] $tickets
 * @property-read int|null $tickets_count
 * @method static Builder|Customer newModelQuery()
 * @method static Builder|Customer newQuery()
 * @method static Builder|Customer onlyTrashed()
 * @method static Builder|Customer query()
 * @method static Builder|Customer whereBillingAddress($value)
 * @method static Builder|Customer whereCreatedAt($value)
 * @method static Builder|Customer whereDefaultAddress($value)
 * @method static Builder|Customer whereDeletedAt($value)
 * @method static Builder|Customer whereId($value)
 * @method static Builder|Customer whereName($value)
 * @method static Builder|Customer wherePhone($value)
 * @method static Builder|Customer wherePrimaryContact($value)
 * @method static Builder|Customer whereShippingAddress($value)
 * @method static Builder|Customer whereTaxable($value)
 * @method static Builder|Customer whereType($value)
 * @method static Builder|Customer whereUpdatedAt($value)
 * @method static Builder|Customer withTrashed()
 * @method static Builder|Customer withoutTrashed()
 * @mixin Eloquent
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
        'billing_address',
    ];

    protected $casts = [
        'taxable' => 'boolean',
    ];

    protected $appends = [
        'displayable_taxable',
        'displayable_phone',
    ];

    public function getDisplayablePhoneAttribute($attribute): string
    {
        if ($attribute === null) {
            return '';
        }

        return PhoneNumber::make($attribute, 'US')->formatNational();
    }

    public function getDisplayableTaxableAttribute(): string
    {
        return $this->taxable ? 'Taxable' : 'Non Taxable';
    }

    public function devices(): HasMany
    {
        return $this->hasMany(Device::class);
    }

    public function locations(): HasMany
    {
        return $this->hasMany(CustomerLocation::class);
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function getPrimaryContact(): HasOne
    {
        return $this->hasOne(CustomerContact::class)->where('id', $this->primary_contact);
    }

    public function getDefaultLocation(): CustomerLocation|null
    {
        return CustomerLocation::find($this->default_address);
    }

    public function getShippingLocation(): CustomerLocation|null
    {
        return CustomerLocation::find($this->shipping_address);
    }

    public function getBillingLocation(): CustomerLocation|null
    {
        return CustomerLocation::find($this->billing_address);
    }

    public function fetchLocations(): Collection
    {
        return collect([
            $this->getDefaultLocation(),
            $this->getBillingLocation(),
            $this->getShippingLocation(),
        ])->concat($this->locations)->whereNotNull()->unique();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logFillable()->logExcept([
            'primary_contact',
            'default_address',
            'shipping_address',
            'billing_address',
            'deleted_at',
            'updated_at',
            'created_at',
        ])->logOnlyDirty();
    }
}

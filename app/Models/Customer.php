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
        'displayable_type',
        'displayable_phone',
        'displayable_created_at'
    ];

    public function getDisplayableCreatedAtAttribute(): string
    {
        return tz($this->created_at);
    }

    public function getDisplayablePhoneAttribute(): string
    {
        if ($this->phone === null) {
            return '';
        }
        return PhoneNumber::make($this->phone, 'US')->formatNational();
    }

    public function getDisplayableTaxableAttribute(): string
    {
        return $this->taxable ? 'Taxable' : 'Non Taxable';
    }

    public function getDisplayableTypeAttribute()
    {
        return collect(trans('types/customer.type'))->get($this->type);
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

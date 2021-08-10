<?php

namespace App\Models;

use App\Traits\ConvertTimezone;
use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Laravelista\Comments\Commentable;
use Propaganistas\LaravelPhone\PhoneNumber;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\Revision;
use Venturecraft\Revisionable\RevisionableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Propaganistas\LaravelPhone\Casts\E164PhoneNumberCast;

/**
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
 * @property-read Collection|Revision[] $revisionHistory
 * @property-read int|null $revision_history_count
 * @property-read Collection|Ticket[] $tickets
 * @property-read int|null $tickets_count
 * @method static \Illuminate\Database\Query\Builder|Customer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Customer withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Customer withoutTrashed()
 */

class Customer extends Model
{
    use HasFactory, RevisionableTrait, SoftDeletes, ConvertTimezone, Commentable;

    protected $fillable = [
        'name',
        'phone',
        'type',
        'taxable'
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
        return $this->taxable?"Taxable":"Non Taxable";
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

    public function getPhoneAttribute($attribute): string
    {
        return PhoneNumber::make($attribute, 'US')->formatNational();
    }

    protected bool $revisionCreationsEnabled = true;
    protected array $revisionFormattedFieldNames = [
        'name'      => 'Name',
        'phone'     => 'Phone',
        'type'      => 'Customer Type',
        'taxable'   => 'Tax Status',
        'created_at'=> 'Record Created'
    ];
    protected array $revisionFormattedFields = [
        'taxable'     => 'boolean:Non Taxable|Taxable'
    ];
}

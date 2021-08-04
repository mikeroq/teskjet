<?php

namespace App\Models;

use App\Traits\ConvertTimezone;
use Illuminate\Database\Eloquent\Model;
use Propaganistas\LaravelPhone\PhoneNumber;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Propaganistas\LaravelPhone\Casts\E164PhoneNumberCast;

/**
 * Customer
 *
 * @mixin Eloquent
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
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
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Device[] $devices
 * @property-read int|null $devices_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CustomerLocation[] $locations
 * @property-read int|null $locations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read int|null $revision_history_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Ticket[] $tickets
 * @property-read int|null $tickets_count
 * @method static \Illuminate\Database\Query\Builder|Customer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Customer withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Customer withoutTrashed()
 */

class Customer extends Model
{
    use HasFactory, RevisionableTrait, SoftDeletes, ConvertTimezone;

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

    public function getDisplayableTaxableAttribute()
    {
        return $this->taxable?"Taxable":"Non Taxable";
    }

    public function getTypeAttribute($attribute)
    {
        return collect(trans('types/customer.type'))->get($attribute);
    }
    public function devices()
    {
        return $this->hasMany('App\Models\Device');
    }

    public function locations()
    {
        return $this->hasMany('App\Models\CustomerLocation');
    }

    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket');
    }

    public function getFormattedPhoneAttribute()
    {
        return PhoneNumber::make($this->phone, 'US')->formatNational();
    }

    protected $revisionCreationsEnabled = true;
    protected $revisionFormattedFieldNames = [
        'name'      => 'Name',
        'phone'     => 'Phone',
        'type'      => 'Customer Type',
        'taxable'   => 'Tax Status',
        'created_at'=> 'Record Created'
    ];
    protected $revisionFormattedFields = [
        'taxable'     => 'boolean:Non Taxable|Taxable'
    ];
}

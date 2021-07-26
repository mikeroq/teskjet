<?php

namespace App;

use App\Traits\ConvertTimezone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
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

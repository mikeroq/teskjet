<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CustomerLocation
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $customer_id
 * @property string $name
 * @property string $address
 * @property string $address_2
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $phone
 * @property-read \App\Models\Customer $customer
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerLocation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerLocation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerLocation query()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerLocation whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerLocation whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerLocation whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerLocation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerLocation whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerLocation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerLocation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerLocation wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerLocation whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerLocation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerLocation whereZip($value)
 * @mixin \Eloquent
 */
class CustomerLocation extends Model
{
    use HasFactory;

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }
}

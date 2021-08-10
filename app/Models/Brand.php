<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Brand
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $name
 * @property string|null $website
 * @property string|null $support_number
 * @method static Builder|Brand newModelQuery()
 * @method static Builder|Brand newQuery()
 * @method static Builder|Brand query()
 * @method static Builder|Brand whereCreatedAt($value)
 * @method static Builder|Brand whereId($value)
 * @method static Builder|Brand whereName($value)
 * @method static Builder|Brand whereSupportNumber($value)
 * @method static Builder|Brand whereUpdatedAt($value)
 * @method static Builder|Brand whereWebsite($value)
 * @mixin Eloquent
 * @property-read Collection|Device[] $devices
 * @property-read int|null $devices_count
 */
class Brand extends Model
{
    use HasFactory;

    public function devices(): HasMany
    {
        return $this->hasMany('App\Models\Device');
    }

    protected $fillable = [
        'name',
        'website',
        'support_number'
    ];
}

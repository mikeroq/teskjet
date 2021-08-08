<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\NavigationType
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property string $slug
 * @property int $children
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Navigation[] $navigations
 * @property-read int|null $navigations_count
 * @method static Builder|NavigationType newModelQuery()
 * @method static Builder|NavigationType newQuery()
 * @method static Builder|NavigationType query()
 * @method static Builder|NavigationType whereChildren($value)
 * @method static Builder|NavigationType whereCreatedAt($value)
 * @method static Builder|NavigationType whereId($value)
 * @method static Builder|NavigationType whereName($value)
 * @method static Builder|NavigationType whereSlug($value)
 * @method static Builder|NavigationType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class NavigationType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];



    public function navigations()
    {
        return $this->hasMany('\App\Models\Navigation');
    }
}

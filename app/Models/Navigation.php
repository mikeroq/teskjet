<?php

namespace App\Models;

use App\Listeners\NavigationUpdate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * App\Navigation
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $parent_id
 * @property string $title
 * @property string $icon
 * @property string|null $url
 * @property string $route
 * @property int $user_level
 * @property int $order_id
 * @property-read Navigation $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|Navigation[] $subcategories
 * @property-read int|null $subcategories_count
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereUserLevel($value)
 * @mixin \Eloquent
 */
class Navigation extends Model implements Sortable
{
    use HasFactory;
    use SortableTrait;
    use Notifiable;

    protected $fillable = [
        'navigation_type_id',
        'title',
        'icon',
        'url',
        'user_level',
        'order_column'
    ];

    public function buildSortQuery()
    {
        return static::query()->where('navigation_type_id', $this->navigation_type_id);
    }

    public function children()
    {
        return $this->hasMany('\App\Models\NavigationChild');
    }

    public function parent()
    {
        return $this->belongsTo('\App\Models\NavigationType');
    }
}

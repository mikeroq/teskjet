<?php

namespace App\Models;

use App\Services\GenerateNavigationService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * App\Navigation
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $parent_id
 * @property string $title
 * @property string $icon
 * @property string|null $url
 * @property string $route
 * @property bool $is_hidden
 * @property int $user_level
 * @property int $order_id
 * @property-read Navigation $parent
 * @property-read Collection|Navigation[] $subcategories
 * @property-read int|null $subcategories_count
 * @method static Builder|Navigation newModelQuery()
 * @method static Builder|Navigation newQuery()
 * @method static Builder|Navigation query()
 * @method static Builder|Navigation whereCreatedAt($value)
 * @method static Builder|Navigation whereIcon($value)
 * @method static Builder|Navigation whereId($value)
 * @method static Builder|Navigation whereOrderId($value)
 * @method static Builder|Navigation whereParentId($value)
 * @method static Builder|Navigation whereRoute($value)
 * @method static Builder|Navigation whereTitle($value)
 * @method static Builder|Navigation whereUpdatedAt($value)
 * @method static Builder|Navigation whereUrl($value)
 * @method static Builder|Navigation whereUserLevel($value)
 * @mixin \Eloquent
 * @property int $navigation_type_id
 * @property int $order_column
 * @property-read Collection|NavigationChild[] $children
 * @property-read int|null $children_count
 * @property-read mixed $level
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static Builder|Navigation ordered(string $direction = 'asc')
 * @method static Builder|Navigation whereNavigationTypeId($value)
 * @method static Builder|Navigation whereOrderColumn($value)
 * @property Carbon|null $deleted_at
 * @property-read string $displayable_hidden
 * @method static \Illuminate\Database\Query\Builder|Navigation onlyTrashed()
 * @method static Builder|Navigation whereDeletedAt($value)
 * @method static Builder|Navigation whereIsHidden($value)
 * @method static \Illuminate\Database\Query\Builder|Navigation withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Navigation withoutTrashed()
 */
class Navigation extends Model implements Sortable
{
    use HasFactory;
    use SortableTrait;
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'navigation_type_id',
        'title',
        'icon',
        'url',
        'user_level',
        'is_hidden',
        'order_column',
    ];

    protected $casts = [
        'is_hidden' => 'boolean',
    ];

    protected $appends = [
        'displayable_hidden',
    ];

    public function buildSortQuery(): self|Builder
    {
        return static::query()->where('navigation_type_id', $this->navigation_type_id);
    }

    public function children(): HasMany
    {
        return $this->hasMany(NavigationChild::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(NavigationType::class);
    }

    protected static function booted() :void
    {
        static::saved(function () {
            GenerateNavigationService::generate();
        });
        static::deleted(function () {
            GenerateNavigationService::generate();
        });
    }

    public function getDisplayableHiddenAttribute(): string
    {
        return $this->is_hidden ? 'Yes' : 'No';
    }
}

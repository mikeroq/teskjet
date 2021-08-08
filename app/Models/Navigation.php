<?php

namespace App\Models;

use App\Enums\UserType;
use BenSampo\Enum\Traits\CastsEnums;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\EloquentSortable\SortableTrait;
use App\Services\GenerateNavigationService;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
 * @property UserType $user_level
 * @property int $order_id
 * @property-read Navigation $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|Navigation[] $subcategories
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\NavigationChild[] $children
 * @property-read int|null $children_count
 * @property-read mixed $level
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static Builder|Navigation ordered(string $direction = 'asc')
 * @method static Builder|Navigation whereNavigationTypeId($value)
 * @method static Builder|Navigation whereOrderColumn($value)
 */
class Navigation extends Model implements Sortable
{
    use HasFactory;
    use SortableTrait;
    use Notifiable;
    use CastsEnums;
    use SoftDeletes;

    protected $fillable = [
        'navigation_type_id',
        'title',
        'icon',
        'url',
        'user_level',
        'order_column'
    ];

    protected $casts = [
        'user_level' => UserType::class,
    ];

    public function buildSortQuery(): Navigation|Builder
    {
        return static::query()->where('navigation_type_id', $this->navigation_type_id);
    }

    public function children(): HasMany
    {
        return $this->hasMany('\App\Models\NavigationChild');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo('\App\Models\NavigationType');
    }

    protected static function booted() :void
    {
        static::saved(function () {
            GenerateNavigationService::generate();
        });
    }

    public function getLevelAttribute()
    {
        return $this->user_level->description;
    }
}

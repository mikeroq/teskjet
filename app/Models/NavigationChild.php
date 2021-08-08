<?php

namespace App\Models;

use App\Enums\UserType;
use BenSampo\Enum\Traits\CastsEnums;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\EloquentSortable\SortableTrait;
use App\Services\GenerateNavigationService;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\NavigationChild
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $navigation_id
 * @property string $title
 * @property string|null $url
 * @property UserType $user_level
 * @property int $order_column
 * @property-read mixed $level
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Navigation $parent
 * @method static Builder|NavigationChild newModelQuery()
 * @method static Builder|NavigationChild newQuery()
 * @method static Builder|NavigationChild ordered(string $direction = 'asc')
 * @method static Builder|NavigationChild query()
 * @method static Builder|NavigationChild whereCreatedAt($value)
 * @method static Builder|NavigationChild whereId($value)
 * @method static Builder|NavigationChild whereNavigationId($value)
 * @method static Builder|NavigationChild whereOrderColumn($value)
 * @method static Builder|NavigationChild whereTitle($value)
 * @method static Builder|NavigationChild whereUpdatedAt($value)
 * @method static Builder|NavigationChild whereUrl($value)
 * @method static Builder|NavigationChild whereUserLevel($value)
 * @mixin \Eloquent
 */
class NavigationChild extends Model implements Sortable
{
    use HasFactory;
    use SortableTrait;
    use Notifiable;
    use CastsEnums;
    use SoftDeletes;

    public function buildSortQuery(): Builder|NavigationChild
    {
        return static::query()->where('navigation_id', $this->navigation_id);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo('\App\Models\Navigation', 'navigation_id');
    }

    protected $fillable = [
        'navigation_id',
        'title',
        'url',
        'user_level',
        'order_column'
    ];

    protected $casts = [
        'user_level' => UserType::class,
    ];

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

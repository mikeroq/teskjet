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

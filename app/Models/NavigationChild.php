<?php

namespace App\Models;

use App\Services\GenerateNavigationService;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class NavigationChild extends Model implements Sortable
{
    use HasFactory;
    use SortableTrait;
    use Notifiable;
    use SoftDeletes;

    public function buildSortQuery(): Builder|NavigationChild
    {
        return static::query()->where('navigation_id', $this->navigation_id);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Navigation::class, 'navigation_id');
    }

    protected $fillable = [
        'navigation_id',
        'title',
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

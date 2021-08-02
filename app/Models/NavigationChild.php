<?php

namespace App\Models;

use App\Listeners\NavigationUpdate;
use Spatie\EloquentSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\EloquentSortable\SortableTrait;
use App\Services\GenerateNavigationService;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NavigationChild extends Model implements Sortable
{
    use HasFactory;
    use SortableTrait;
    use Notifiable;

    public function buildSortQuery()
    {
        return static::query()->where('navigation_id', $this->navigation_id);
    }

    public function parent()
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

    protected static function booted()
    {
        static::saved(function () {
            GenerateNavigationService::generate();
        });
    }

}

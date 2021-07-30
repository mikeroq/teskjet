<?php

namespace App\Models;

use App\Listeners\NavigationUpdate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

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
}

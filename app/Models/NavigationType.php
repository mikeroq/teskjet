<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\View;

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
 * @method static \Illuminate\Database\Eloquent\Builder|NavigationType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NavigationType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NavigationType query()
 * @method static \Illuminate\Database\Eloquent\Builder|NavigationType whereChildren($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NavigationType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NavigationType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NavigationType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NavigationType whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NavigationType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class NavigationType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function renderHTML()
    {
        $pages = Navigation::with('children')->where('navigation_type_id', $this->id)->orderBy('order_column', 'asc')->get();
        return View::make('admin.navtable', ['parent_pages' => $pages])->render();
    }

    public function navigations()
    {
        return $this->hasMany('\App\Models\Navigation');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\View;

class NavigationType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function renderHTML() {
        $pages = Navigation::where('navigation_type_id', $this->id)->orderBy('order_column', 'asc')->get();
        return View::make('admin.navtable', ['parent_pages' => $pages])->render();
    }

    public function navigations() {
        return $this->hasMany('\App\Models\Navigation');
    }
}

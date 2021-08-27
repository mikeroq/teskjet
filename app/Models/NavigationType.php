<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class NavigationType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function navigations(): HasMany
    {
        return $this->hasMany(Navigation::class);
    }
}

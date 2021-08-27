<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class Brand extends Model
{
    use HasFactory;

    public function devices(): HasMany
    {
        return $this->hasMany(Device::class);
    }

    protected $fillable = [
        'name',
        'website',
        'support_number',
    ];
}

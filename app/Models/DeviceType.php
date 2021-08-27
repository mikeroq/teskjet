<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class DeviceType extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function devices(): HasMany
    {
        return $this->hasMany(Device::class);
    }

    protected $fillable = [
        'name',
    ];
}

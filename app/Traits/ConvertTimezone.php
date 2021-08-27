<?php

namespace App\Traits;

use Carbon\Carbon;
use Carbon\CarbonTimeZone;
use Illuminate\Support\Facades\Auth;

trait ConvertTimezone
{
    public function getTz()
    {
        return auth()->user()->timezone ?? 'UTC';
    }

    public function getCreatedAtAttribute($value): Carbon
    {
        return (new Carbon($value))->setTimezone(new CarbonTimeZone($this->getTz()));
    }

    public function getUpdatedAtAttribute($value): Carbon
    {
        return (new Carbon($value))->setTimezone(new CarbonTimeZone($this->getTz()));
    }
}

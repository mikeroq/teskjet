<?php

namespace App\Traits;

use Carbon\Carbon;
use Carbon\CarbonTimeZone;
use Auth;

trait ConvertTimezone
{

    public function getTz()
    {
        return auth()->user()->timezone ?? 'UTC';
    }

    /**
     * @param $value
     * @return Carbon
     */
    public function getCreatedAtAttribute($value): Carbon
    {
        return (new Carbon($value))->setTimezone(new CarbonTimeZone($this->getTz()));
    }

    /**
     * @param $value
     * @return Carbon
     */
    public function getUpdatedAtAttribute($value): Carbon
    {
        return (new Carbon($value))->setTimezone(new CarbonTimeZone($this->getTz()));
    }
}

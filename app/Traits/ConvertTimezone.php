<?php
namespace App\Traits;
use Carbon\Carbon;
use Carbon\CarbonTimeZone;
use Auth;

trait ConvertTimezone
    {
        public $tz = 'UTC';

        public function getTz()
        {
            return $this->tz = Auth::user()->timezone;
        }

        public function getCreatedAtAttribute($value)
        {
            return (new Carbon($value))->setTimezone(new CarbonTimeZone($this->getTz()));
        }

        public function getUpdatedAtAttribute($value)
        {
            return (new Carbon($value))->setTimezone(new CarbonTimeZone($this->getTz()));
        }
    }

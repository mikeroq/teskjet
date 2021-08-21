<?php

use Illuminate\Support\Carbon;

if (!function_exists('tz')) {
    function tz(Carbon $carbon, $format = 'M jS, Y g:ia'): String
    {
        if ($carbon->isCurrentDay()) {
            return $carbon->diffForHumans();
        }
        return $carbon->tz(auth()->user()->timezone)->format($format);
    }
}

if (!function_exists('activity_config')) {
    function activity_config($subject)
    {
        return Config::get("tesk.activity.$subject");
    }
}
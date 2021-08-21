<?php

use Illuminate\Support\Carbon;

if (!function_exists('tz')) {
    function tz(Carbon $carbon, $format = 'M jS, Y g:ia'): String
    {
        return $carbon->tz(auth()->user()->timezone)->format($format);
    }
}
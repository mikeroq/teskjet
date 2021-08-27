<?php

use Illuminate\Support\Carbon;

if (! function_exists('tz')) {
    function tz(Carbon $carbon, Bool $skipDifference = false, String $format = 'M jS, Y g:i a'): String
    {
        if ($skipDifference) {
            return $carbon->tz(auth()->user()->timezone)->format($format);
        }
        if ($carbon->diffInMinutes(now()) <= 59) {
            return $carbon->diffForHumans();
        }
        if ($carbon->tz(auth()->user()->timezone)->isCurrentDay()) {
            return 'Today, '.$carbon->tz(auth()->user()->timezone)->format('g:i a');
        }
        if ($carbon->tz(auth()->user()->timezone)->isYesterday()) {
            return 'Yesterday, '.$carbon->tz(auth()->user()->timezone)->format('g:i a');
        }

        return $carbon->tz(auth()->user()->timezone)->format($format);
    }
}

if (! function_exists('activity_config')) {
    function activity_config($subject)
    {
        return config("tesk.activity.$subject");
    }
}

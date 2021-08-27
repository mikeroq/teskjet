<?php

namespace App\Actions\Socialstream;

use JoelButcher\Socialstream\Contracts\HandlesInvalidState;
use Laravel\Socialite\Two\InvalidStateException;

class HandleInvalidState implements HandlesInvalidState
{
    public function handle(InvalidStateException $exception, callable $callback = null): mixed
    {
        if ($callback) {
            return $callback($exception);
        }

        throw $exception;
    }
}

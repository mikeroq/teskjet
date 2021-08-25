<?php

namespace Pwncraft\LivewireAlert;

use Illuminate\Support\Facades\Facade;

/**
 * @see \pwncraft\LivewireAlert\Skeleton\SkeletonClass
 */
class LivewireAlertFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'livewire-alert';
    }
}

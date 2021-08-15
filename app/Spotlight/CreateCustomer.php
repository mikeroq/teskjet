<?php

namespace App\Spotlight;

use LivewireUI\Spotlight\Spotlight;
use LivewireUI\Spotlight\SpotlightCommand;
use LivewireUI\Spotlight\SpotlightCommandDependencies;
use LivewireUI\Spotlight\SpotlightCommandDependency;
use LivewireUI\Spotlight\SpotlightSearchResult;

class CreateCustomer extends SpotlightCommand
{
    protected string $name = 'Create Customer';
    protected string $description = 'Open modal';

    public function execute(Spotlight $spotlight)
    {
        $spotlight->emit('openModal', 'customer.modals.create-customer-modal');
    }

    public function shouldBeShown(): bool
    {
        return true;
    }
}

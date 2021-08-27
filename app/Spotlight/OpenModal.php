<?php

namespace App\Spotlight;

use LivewireUI\Spotlight\Spotlight;
use LivewireUI\Spotlight\SpotlightCommand;
use LivewireUI\Spotlight\SpotlightCommandDependencies;
use LivewireUI\Spotlight\SpotlightCommandDependency;
use LivewireUI\Spotlight\SpotlightSearchResult;

class OpenModal extends SpotlightCommand
{
    protected string $name = 'Open Modal';
    protected string $description = 'Open a modal';

    public function dependencies(): ?SpotlightCommandDependencies
    {
        return SpotlightCommandDependencies::collection()
        ->add(SpotlightCommandDependency::make('name')->setPlaceholder('Enter the modal name?')->setType(SpotlightCommandDependency::INPUT));
    }

    public function execute(Spotlight $spotlight, string $name)
    {
        $spotlight->emit('openModal', $name);
    }

    public function shouldBeShown(): bool
    {
        return auth()->user()->can('spotlight modal');
    }
}

<?php

namespace App\Spotlight;

use LivewireUI\Spotlight\Spotlight;
use LivewireUI\Spotlight\SpotlightCommand;
use LivewireUI\Spotlight\SpotlightCommandDependencies;
use LivewireUI\Spotlight\SpotlightCommandDependency;
use LivewireUI\Spotlight\SpotlightSearchResult;

class Logout extends SpotlightCommand
{
    protected string $name = 'Logout';

    protected string $description = 'Logs you out of teskjet';

    public function execute(Spotlight $spotlight, Team $team)
    {
        auth()->logout();
        $spotlight->redirect('/');
    }

    public function shouldBeShown(): bool
    {
        return true;
    }
}

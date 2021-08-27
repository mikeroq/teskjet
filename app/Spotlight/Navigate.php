<?php

namespace App\Spotlight;

use App\Models\Navigation;
use LivewireUI\Spotlight\Spotlight;
use LivewireUI\Spotlight\SpotlightCommand;
use LivewireUI\Spotlight\SpotlightCommandDependencies;
use LivewireUI\Spotlight\SpotlightCommandDependency;
use LivewireUI\Spotlight\SpotlightSearchResult;

class Navigate extends SpotlightCommand
{
    protected string $name = 'Navigate';

    protected string $description = 'Navigate to page';

    public function dependencies(): ?SpotlightCommandDependencies
    {
        return SpotlightCommandDependencies::collection()
            ->add(
                // In this example we will register a 'team' dependency
                SpotlightCommandDependency::make('navigation')
                // The default Spotlight placeholder will be changed to your dependency place holder
                ->setPlaceholder('What page do you want to go to?')
            );
    }

    public function searchNavigation($query)
    {
        return Navigation::with('children')->where('title', 'like', "%$query%")
            ->get()
            ->map(fn (Navigation $navigation) => new SpotlightSearchResult(
                $navigation->id,
                $navigation->title,
                sprintf('Goto %s', $navigation->url)
            ));
    }

    public function execute(Spotlight $spotlight, Navigation $navigation)
    {
        $spotlight->redirect('/'.$navigation->url);
    }

    public function shouldBeShown(): bool
    {
        return true;
    }
}

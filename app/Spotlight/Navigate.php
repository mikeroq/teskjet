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
    /**
     * This is the name of the command that will be shown in the Spotlight component.
     */
    protected string $name = 'Navigate';

    /**
     * This is the description of your command which will be shown besides the command name.
     */
    protected string $description = 'Navigate to page';

    /**
     * Defining dependencies is optional. If you don't have any dependencies you can remove this method.
     * Dependencies are asked from your user in the order you add the dependencies.
     */
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

    /**
     * Spotlight will resolve dependencies by calling the search method followed by your dependency name.
     * The method will receive the search query as the parameter.
     */
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

    /**
     * When all dependencies have been resolved the execute method is called.
     * You can type-hint all resolved dependency you defined earlier.
     */
    public function execute(Spotlight $spotlight, Navigation $navigation)
    {
        $spotlight->redirect('/'.$navigation->url);
    }

    /**
     * You can provide any custom logic you want to determine whether the
     * command will be shown in the Spotlight component. If you don't have any
     * logic you can remove this method. You can type-hint any dependencies you
     * need and they will be resolved from the container.
     */
    public function shouldBeShown(): bool
    {
        return true;
    }
}

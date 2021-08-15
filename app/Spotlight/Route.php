<?php

namespace App\Spotlight;

use LivewireUI\Spotlight\Spotlight;
use LivewireUI\Spotlight\SpotlightCommand;
use LivewireUI\Spotlight\SpotlightCommandDependencies;
use LivewireUI\Spotlight\SpotlightCommandDependency;
use LivewireUI\Spotlight\SpotlightSearchResult;

class Route extends SpotlightCommand
{
    /**
     * This is the name of the command that will be shown in the Spotlight component.
     */
    protected string $name = 'Route';

    /**
     * This is the description of your command which will be shown besides the command name.
     */
    protected string $description = 'Redirect to route';

    /**
     * Defining dependencies is optional. If you don't have any dependencies you can remove this method.
     * Dependencies are asked from your user in the order you add the dependencies.
     */
    public function dependencies(): ?SpotlightCommandDependencies
    {
        return SpotlightCommandDependencies::collection()
            ->add(
                // In this example we will register a 'team' dependency
                SpotlightCommandDependency::make('RouteName')
                // The default Spotlight placeholder will be changed to your dependency place holder
                ->setPlaceholder('What route do you want to go to?')
            );
    }

    /**
     * Spotlight will resolve dependencies by calling the search method followed by your dependency name.
     * The method will receive the search query as the parameter.
     */
    public function searchRoute($query)
    {
        $routes = \Illuminate\Support\Facades\Route::getRoutes();
        $collect = collect();
        foreach ($routes as $route) {
            $collect->add($route->getName());
        }
        return $collect->filter()->filter(function ($item) use ($query) {
            return false !== stripos($item, $query);
        })->map(function($route) {
            return new SpotlightSearchResult(
                $route,
                $route,
                sprintf('Goto route %s', $route)
            );
        });
    }

    /**
     * When all dependencies have been resolved the execute method is called.
     * You can type-hint all resolved dependency you defined earlier.
     */
    public function execute(Spotlight $spotlight, RouteName $route)
    {
        $spotlight->redirectRoute($route);
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

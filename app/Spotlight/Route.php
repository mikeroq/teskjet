<?php

namespace App\Spotlight;

use LivewireUI\Spotlight\Spotlight;
use LivewireUI\Spotlight\SpotlightCommand;
use LivewireUI\Spotlight\SpotlightCommandDependencies;
use LivewireUI\Spotlight\SpotlightCommandDependency;
use LivewireUI\Spotlight\SpotlightSearchResult;

class Route extends SpotlightCommand
{
    protected string $name = 'Route';

    protected string $description = 'Redirect to route';

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

    public function searchRoute($query)
    {
        $routes = \Illuminate\Support\Facades\Route::getRoutes();
        $collect = collect();
        foreach ($routes as $route) {
            $collect->add($route->getName());
        }

        return $collect->filter()->filter(fn ($item) => false !== stripos($item, $query))->map(fn ($route) => new SpotlightSearchResult(
            $route,
            $route,
            sprintf('Goto route %s', $route)
        ));
    }

    public function execute(Spotlight $spotlight, RouteName $route)
    {
        $spotlight->redirectRoute($route);
    }

    public function shouldBeShown(): bool
    {
        return true;
    }
}

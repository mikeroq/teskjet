<?php

namespace App\Spotlight;

use App\Models\Customer;
use LivewireUI\Spotlight\Spotlight;
use LivewireUI\Spotlight\SpotlightCommand;
use LivewireUI\Spotlight\SpotlightCommandDependencies;
use LivewireUI\Spotlight\SpotlightCommandDependency;
use LivewireUI\Spotlight\SpotlightSearchResult;

class ViewCustomer extends SpotlightCommand
{
    protected string $name = 'View Customer';

    protected string $description = 'Redirect to customer';

    public function dependencies(): ?SpotlightCommandDependencies
    {
        return SpotlightCommandDependencies::collection()
            ->add(
                // In this example we will register a 'team' dependency
                SpotlightCommandDependency::make('customer')
                // The default Spotlight placeholder will be changed to your dependency place holder
                ->setPlaceholder('Which customer do you want to go to?')
            );
    }

    public function searchCustomer($query)
    {
        return Customer::where('name', 'like', "%$query%")
            ->get()
            ->map(fn (Customer $customer) => new SpotlightSearchResult(
                $customer->id,
                $customer->name,
                sprintf('ID: %s', $customer->id)
            ));
    }

    public function execute(Spotlight $spotlight, Customer $customer)
    {
        $spotlight->redirectRoute('customers.show', $customer);
    }

    public function shouldBeShown(): bool
    {
        return true;
    }
}

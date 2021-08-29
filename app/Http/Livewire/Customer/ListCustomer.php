<?php

namespace App\Http\Livewire\Customer;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ListCustomer extends DataTableComponent
{
    public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('Phone', 'displayable_phone')
                ->sortable()
                ->searchable(),
            Column::make('Type', 'displayable_type')
                ->sortable()
                ->searchable(),
            Column::make('Taxable', 'displayable_taxable')
                ->sortable()
                ->searchable(),
            Column::make('Created At', 'displayable_created_at')
                ->sortable()
                ->searchable(),
        ];
    }

    public function getTableRowUrl($row): string
    {
        return route('customers.show', $row);
    }

    public function query(): Builder
    {
        return Customer::query();
    }
}

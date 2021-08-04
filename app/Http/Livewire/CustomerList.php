<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Customer;

class CustomerList extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('Phone', 'formatted_phone')
                ->sortable()
                ->searchable(),
            Column::make('Type')
                ->sortable()
                ->searchable(),
            Column::make('Created At')
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

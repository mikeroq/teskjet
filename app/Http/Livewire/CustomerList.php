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
            Column::make('Phone')
                ->sortable()
                ->searchable(),
            Column::make('Type')
                ->sortable()
                ->searchable(),
        ];
    }

    public function query(): Builder
    {
        return Customer::query();
    }
}

<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Spatie\Permission\Models\Role;

class RoleTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('Description')
                ->sortable()
                ->searchable(),
            Column::make('Guard', 'guard_name')
                ->sortable()
                ->searchable(),
            Column::make('Created At')
                ->sortable()
                ->searchable(),
        ];
    }

    public function getTableRowUrl($row): string
    {
        return route('admin.roles.show', $row);
    }

    public function query(): Builder
    {
        return Role::query();
    }
}

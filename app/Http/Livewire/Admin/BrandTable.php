<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Brand;

class BrandTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make('Name')
            ->sortable()
            ->searchable(),
        Column::make('Website')
            ->sortable()
            ->searchable(),
        Column::make('Support Number')
            ->sortable()
            ->searchable(),
        ];
    }

    public function query(): Builder
    {
        return Brand::query();
    }
}

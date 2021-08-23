<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Brand;

class BrandTable extends DataTableComponent
{
    public string $delete_id;

    protected $listeners = [
        'refreshBrandTable' => '$refresh',
        'confirmedDelete',
        'cancelledDelete'
    ];

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
        Column::make('Actions')->addClass('text-end')
        ];

    }

    public function rowView(): string
    {
        return 'admin.brand-row';
    }

    public function query(): Builder
    {
        return Brand::query();
    }

    public function triggerDelete($delete_id): void
    {
        $this->delete_id = $delete_id;
        self::confirm('Are you sure you want to delete?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => 'Nope',
            'onConfirmed' => 'confirmedDelete',
            'onCancelled' => 'cancelledDelete'
        ]);
    }

    public function confirmedDelete(): void
    {
        Brand::findorFail($this->delete_id)->delete();

        self::alert(
            'success',
            'Brand deleted!'
        );
    }
}

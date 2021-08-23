<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\DeviceType;

class DeviceTypeTable extends DataTableComponent
{
    public string $delete_id;

    protected $listeners = [
        'refreshDeviceTypeTable' => '$refresh',
        'confirmedDelete',
        'cancelledDelete'
    ];

    public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('Actions')->addClass('text-end')
        ];
    }

    public function rowView(): string
    {
        return 'admin.device-type-row';
    }

    public function query(): Builder
    {
        return DeviceType::query();
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
        DeviceType::findorFail($this->delete_id)->delete();

        self::alert(
            'success',
            'Device Type deleted!'
        );
    }
}

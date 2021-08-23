<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Spatie\Permission\Models\Role;

class RoleTable extends DataTableComponent
{
    public mixed $delete_id;

    protected $listeners = [
        'refreshRoleTable' => '$refresh',
        'confirmedDelete',
        'cancelledDelete'
    ];

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
            Column::make('Actions')->addClass('text-end')
        ];
    }

    public function rowView(): string
    {
        return 'admin.role-row';
    }

//    public function getTableRowUrl($row): string
//    {
//        return route('admin.roles.show', $row);
//    }

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
        Role::findorFail($this->delete_id)->delete();

        self::alert(
            'success',
            'Role deleted!'
        );
    }

    public function query(): Builder
    {
        return Role::query();
    }
}

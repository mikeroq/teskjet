<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UserTable extends DataTableComponent
{
    public mixed $delete_id;

    protected $listeners = [
        'refreshUserTable' => '$refresh',
        'confirmedDelete',
        'cancelledDelete',
    ];

    public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('Email')
                ->sortable()
                ->searchable(),
            Column::make('Roles', 'userRoles')
                ->sortable()
                ->searchable(),
            Column::make('Actions')->addClass('text-end'),
        ];
    }

    public function rowView(): string
    {
        return 'admin.user-row';
    }

    public function triggerDelete($delete_id): void
    {
        $this->delete_id = $delete_id;
        self::confirm('Are you sure you want to delete?', [
            'onConfirmed' => 'confirmedDelete',
            'onCancelled' => 'cancelledDelete',
        ]);
    }

    public function confirmedDelete(): void
    {
        User::findOrFail($this->delete_id)->delete();
        self::alert(
            'success',
            'User deleted!'
        );
    }

    public function cancelledDelete(): void
    {
        self::alert('info', 'User was not deleted.');
    }

    public function query(): Builder
    {
        return User::query();
    }
}

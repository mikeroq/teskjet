<x-livewire-tables::bs5.table.cell>
    {{ $row->name }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->email }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->userRoles }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-end">
    <div class="btn-group" role="group">
        <button onclick="this.blur()" class="btn btn-sm btn-secondary" wire:click="triggerDelete({{ $row->id }})" title="Delete User"><i class="far fa-trash-alt fa-fw"></i></button>
    </div>
</x-livewire-tables::bs5.table.cell>
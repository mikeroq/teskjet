<x-livewire-tables::bs5.table.cell>
    {{ $row->name }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-end">
    <div class="btn-group" role="group">
        <button onclick="this.blur()" class="btn btn-sm btn-secondary" wire:click="$emit('openModal', 'admin.modals.edit-device-type', {{ json_encode(['id' => $row->id], JSON_THROW_ON_ERROR) }})" title="Edit Device Type"><i class="fas fa-pencil-alt fa-fw"></i></button>
        <button onclick="this.blur()" class="btn btn-sm btn-secondary" wire:click="triggerDelete({{ $row->id }})" title="Delete Device Type"><i class="far fa-trash-alt fa-fw"></i></button>
    </div>
</x-livewire-tables::bs5.table.cell>
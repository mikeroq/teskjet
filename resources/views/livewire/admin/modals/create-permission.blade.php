<div>
    <form wire:submit.prevent="create">
        @csrf
        <div class="block-content">
            <x-input label="Role Name" id="name" wire:model="name" required autofocus />
            <x-text-area label="Description" id="description" wire:model="description" />
        </div>
        <div class="modal-footer modal-footer-fixed bg-dark bg-black-10">
            <button type="submit" class="btn btn-secondary btn-sm">
                <span>Add Permission</span>
            </button>
        </div>
    </form>
</div>
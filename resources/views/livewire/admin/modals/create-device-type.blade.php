<div>
    <form wire:submit.prevent="create">
        @csrf
        <div class="block-content">
            <x-input label="Name" id="name" wire:model="name" required autofocus />
        </div>
        <div class="modal-footer modal-footer-fixed bg-dark bg-black-10">
            <button type="submit" class="btn btn-secondary btn-sm">
                <span>Add Device Type</span>
            </button>
        </div>
    </form>
</div>
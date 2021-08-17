<div>
    <form wire:submit.prevent="create">
        @csrf
        <div class="block-content">
            <x-input label="Brand Name" id="name" wire:model="name" required autofocus />
            <x-input label="Website" id="website" wire:model="website" />
            <x-input label="Support Number" id="support_number" wire:model="support_number" />
        </div>
        <div class="modal-footer modal-footer-fixed bg-dark bg-black-10">
            <button type="submit" class="btn btn-secondary btn-sm">
                <span>Add Brand</span>
            </button>
        </div>
    </form>
</div>